<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\UserVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterUserRequest;

class RegisterController extends Controller
{
    public function RegisterUser(RegisterUserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone
        ]);
        Mail::to($user->email)->send(new UserVerificationMail($user));
        return redirect()->route('login')->with('success', 'User registered successfully! Please check your email for verification.');
    }

}
