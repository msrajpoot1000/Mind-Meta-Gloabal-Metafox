<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
         // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No user found with this email.');
        }

        // ✅ Check if already verified
        if ($user->email_verified_at==null) {
            // dd($request);
            return back()->with('error', 'Please Verify Your Email');
        }

        $request->authenticate();

        $request->session()->regenerate();

       

        
        
        // ✅ Flash success message
        $request->session()->flash('success', 'Successfully logged in!');

        return redirect()->intended(route('dashboard', absolute: false));
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
