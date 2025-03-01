<?php

namespace App\Http\Controllers\customers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();
    $customerName = $user->name;
    $totalBookings = Booking::count();
    $pendingBookings = Booking::where('booking_status', 'pending')->count();
    $completedBookings = Booking::where('booking_status','completed')->count();

    return view('customers.dashboard', compact('totalBookings', 'pendingBookings', 'completedBookings'));
}

}
