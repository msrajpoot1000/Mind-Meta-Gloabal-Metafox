<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;

class MailVerificationController extends Controller
{
    // Show the form to input email
    public function showForm()
    {
        return view('auth.email-request'); // resources/views/auth/email-request.blade.php
    }

     // Handle the form submission
     public function send(Request $request)
{
    // dd($request->email);  
         $request->validate([
             'email' => 'required|email',
             'page' =>'nullable|string'
         ]);
         $page=$request->page;
         
 
         // Find user by email
         $user = User::where('email', $request->email)->first();
 
         if (!$user) {
             return back()->with('error', 'No user found with this email.');
         }
 
         // Generate signed verification URL (valid for 60 mins)
         $verificationUrl = URL::temporarySignedRoute(
             'email.verify',
             Carbon::now()->addMinutes(60),
             ['user' => $user->id]
         );
        
         if($user->email_verified_at){
            return back()->with('error', 'You Already Verified Your Email');
         }

         $userData = [
            'name' => $user->name,
            'email' => $user->email,
        ];
 
         // Send email
         Mail::to($user->email)->send(new VerifyMail($userData, $verificationUrl));
 
         if($page){
            return redirect()->route('login')->with('success', 'Please Verify your email again');
         }else{
            return redirect()->route('login')->with('success', 'Please Verify your email');
         }
         
     }

    public function verifyMail(Request $request, User $user)
    {
        // dd($user);
        // ✅ Check if URL is valid (redundant if you're using 'signed' middleware, but safe)
        if (!URL::hasValidSignature($request)) {
            abort(403, 'This verification link is invalid or has expired.');
        }
        // ✅ This directly saves the value, avoiding mass assignment issues


        // ✅ Check if already verified
        if ($user->email_verified_at) {
            return redirect()->route('login')->with('success', 'Email is already verified.');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        $user->update([
            'email_verified_at' => now(),
        ]);
        
        // ✅ Redirect or login
        return redirect()->route('login')->with('success', 'Your email has been verified successfully.');
    }
}

