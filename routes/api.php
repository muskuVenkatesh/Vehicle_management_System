<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register-user',[RegisterController::class,'RegisterUser']);
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return response()->json(['message' => 'Email verified successfully!']);
// })->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::get('/email/verify/{id}', function (Request $request, $id) {
    $user = User::findOrFail($id);

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        return response()->json(['message' => 'Email successfully verified!']);
    }
    return response()->json(['message' => 'Email is already verified.']);
})->name('verification.verify');

Route::post('/login',[  AuthController::class,'login'])->name('login.verify');


// login
