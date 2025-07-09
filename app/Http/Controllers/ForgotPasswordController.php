<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ForgotPassword;
use App\Models\Companyinfo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Validation\Rules;


class ForgotPasswordController extends Controller
{

    public function sendOtpIndex(){
        return view("auth.forgot-password");
    }
    public function sendOtp(Request $request)
{
    // dd($request);
    //
    // 1. Validate email input
    $request->validate([
        'email' => 'required|email',
    ]);

    // 2. Find user
    $user = User::where('email', $request->email)->first();
    if (!$user) {
        return back()->with('error', 'No user found with this email.')->withInput();
    }

    $userId = $user->id;

    // 3. Generate 6-digit OTP
    $otp = mt_rand(100000, 999999);

    // 4. Get company info
    $companyInfo = Companyinfo::first();
    $companyName = $companyInfo->companyname ?? 'Our Company';

    // 5. Prepare email data
    $details = [
        'email'        => $user->email,
        'otp'          => $otp,
        'company-name' => $companyName,
    ];

    // 6. Send email
    Mail::to($user->email)->send(new ForgotPasswordMail($details));

    // 7. Store OTP with UTC timestamps
    $now = Carbon::now('UTC')->addHours(5)->addMinutes(30);
    // dd($now);

    ForgotPassword::updateOrCreate(
        ['user_id' => $userId],
        [
            'otp'    => $otp,
            'updated_at'  => $now,
            'created_at'  => $now, // only used on insert
        ]
    );

    // 8. Success response
    
    return redirect()->route('verify.otp.index', ['email' => $request->email])->with([
        'success' => 'OTP has been sent to your email address.',
    ]);
    
    
}


public function verifyOtpIndex($email){

    return view("auth.forgot-password",compact('email'));
}

public function verifyOtpStore(Request $request){


    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|string',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $email=$request->input('email');
    $otp = $request->input('otp'); 
    $password = $request->input('password');

    // step 1 
    $user = User::where('email', $email)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'No user found with this email.');
    }

    // step 2
    $forgotPass=ForgotPassword::where('user_id',$user->id)->first();
    if (!$forgotPass) {
        return back()->with('error', 'No OTP request found.');
    }


    // Step 3: Match OTP
    if ($forgotPass->otp !== $request->otp) {
        return back()->with('error', 'Invalid OTP.');
    }

     // Step 4: Check OTP validity (10 minutes)
     $otpCreated = Carbon::parse($forgotPass->updated_at); // or use `otp_created_at` if you have that column
     if ($otpCreated->diffInMinutes(now()) > 10) {
        return back()->with([
            'error' => 'OTP has expired. Please request a new one.',
            'otp-expired' => 10,  // or any variable you want to send
        ]);
        
     }


      // Step 5: Update user password
    $user->password = Hash::make($request->password);
    $user->save();

     // Step 6: Optionally delete or clear the OTP
     $forgotPass->delete(); // or set otp = null and save()


     return redirect()->route('login')->with('success', 'Password has been reset successfully.');
   
}

}
