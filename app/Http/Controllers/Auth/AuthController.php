<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Mail\LoginVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Public function login(Request $request){
    //     $credentials = $request->only('email','password');
    //     $user = User::where('email',$credentials['email'])->first();
    //     if(!$user){
    //         return response()->json(['error'=>'User does not  exist']);

    //     }
    //     if (!$token = auth('api')->attempt($credentials)) {
    //         return response()->json(['error' => 'Invalid credentials'], 401);
    //     }



    //     return response()->json(['token' => $token]);

    // }



public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $user =  User::where('email',$request->only('email'))->first();

    // $token = auth('api')->claims([
    //     'user_id' => $user->id,
    // // ])->login($user);

    // Attempt login
    if (!$token = auth('api')->attempt($request->only('email', 'password'))) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    Mail::to($user->email)->send(new LoginVerificationMail($user));
    return response()->json([
        'token' => $token,
        // 'user' => auth('api')->user()
    ]);
}

}
