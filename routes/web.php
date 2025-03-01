<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\agent\BookingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\driver\DriverController;
use App\Http\Controllers\vehicle\VehicleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\customers\CustomerController;

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
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/dashboard')->with('success', 'You have been logged out successfully!');
    })->name('logout');
    Route::resource('/users', AdminController::class);
    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::post('permissions/assign', [PermissionController::class, 'assignPermissions'])->name('admin.permissions.assign');

});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::resource('/vehicles', VehicleController::class);
    Route::get('/agent/vehicles', [AgentController::class, 'index'])->name('agent.users.index');
    Route::get('/agent/bookings', [AgentController::class, 'GetAllBookings'])->name('agent.bookings.index');
    Route::post('/bookings/update-status/{id}', [AgentController::class, 'updateBookingStatus'])->name('bookings.updateStatus');
    Route::get('/assign-ride', [AgentController::class, 'showAssignRideForm'])->name('assign.ride.form');
    Route::post('/assign-ride', [AgentController::class, 'assignRide'])->name('assign.ride');


    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/dashboard')->with('success', 'You have been logged out successfully!');
    })->name('logout');

    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/bookings/create', [BookingController::class, 'create'])->name('agent.bookings.create');
    Route::get('/agent/assign-driver', [DriverController::class, 'assign'])->name('agent.assign.driver');
});


Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::resource('bookings', BookingController::class);
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/bookings', [BookingController::class, 'index'])->name('customer.bookings');
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully!');
    })->name('logout');
    Route::post('/customer/book-vehicle', [BookingController::class, 'book'])->name('customer.book.vehicle');
    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/customer/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
});

    Route::middleware(['auth', 'role:driver'])->group(function () {
    Route::get('/driver/dashboard', [DriverController::class, 'dashboard'])->name('driver.dashboard');
    Route::get('/driver/assigned-bookings', [DriverController::class, 'assignedBookings'])
    ->name('driver.assignedBookings');
    Route::get('/driver/manage-trips', [DriverController::class, 'manageTrips'])
    ->name('driver.manageTrips');


    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/dashboard')->with('success', 'You have been logged out successfully!');
    })->name('logout');
    });



