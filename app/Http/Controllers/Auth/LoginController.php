<?php

namespace App\Http\Controllers\Auth;
use Str;


use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\LoginVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return back()->with('error', 'Invalid credentials');
    }

    $user = Auth::user();
    $user->login_verification_token = Str::random(60);
    $user->save();

    // Send verification email
    Mail::to($user->email)->send(new LoginVerificationMail($user));
    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard')->with('success', 'A verification email has been sent to your email.');
    } elseif ($user->hasRole('customer')) {
        return redirect()->route('customer.dashboard')->with('success', 'A verification email has been sent to your email.');
    } elseif ($user->hasRole('agent')) {
        return redirect()->route('agent.dashboard')->with('success', 'A verification email has been sent to your email.');
    } elseif ($user->hasRole('driver')) {
        return redirect()->route('driver.dashboard')->with('success', 'A verification email has been sent to your email.');
    }


    return redirect()->route('dashboard')->with('success', 'A verification email has been sent to your email.');
}

public function verify($token)
    {
        $user = User::where('login_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired verification link.');
        }

        // Mark user as verified
        $user->login_verification_token = null;
        $user->save();

        // Log in the user after successful verification
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Login verified successfully!');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        } elseif ($user->hasRole('agent')) {
            return redirect()->route('agent.dashboard');
        } elseif ($user->hasRole('driver')) {
            return redirect()->route('driver.dashboard');
        }

        return redirect()->route('dashboard'); // Default fallback
    }



}
