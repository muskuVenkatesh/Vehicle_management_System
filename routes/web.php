<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',function(){
    return view('auth.login');
})->name('login');

Route::get('register',function(){
    return view('auth.register');
})->name('register');

Route::post('register', [RegisterController::class, 'RegisterUser'])->name('registerUser');
Route::get('/email/verify/{id}', function (Request $request, $id) {
    $user = User::findOrFail($id);

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        return response()->json(['message' => 'Email successfully verified!']);
    }
    return response()->json(['message' => 'Email is already verified.']);
})->name('verification.verify');

Route::post('/login',[  LoginController::class,'login'])->name('loginUser');
Route::get('/login/verify/{token}', [LoginController::class, 'verify'])->name('login.verify');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    // Route::get('/admin/users', [AdminController::class, 'getAllUsers'])->name('admin.users');

    Route::resource('/users', AdminController::class);
    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::post('permissions/assign', [PermissionController::class, 'assignPermissions'])->name('admin.permissions.assign');

});



