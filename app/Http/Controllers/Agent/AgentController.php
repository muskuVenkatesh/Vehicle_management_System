<?php

namespace App\Http\Controllers\Agent;

use App\Models\User;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentController extends Controller
{
    // public function dashboard()
    // {
    //     return view('agent.dashboard');
    // }

    public function AgentDashboard()
{
    $totalBookings = Booking::count();
    $pendingBookings = Booking::where('booking_status', 'pending')->count();
    $completedBookings = Booking::where('booking_status', 'completed')->count();
    $totalVehicles = Vehicle::count();
    // $availableDrivers = Driver::where('status', 'available')->count();

    return view('agent.dashboard', compact('totalBookings', 'pendingBookings', 'completedBookings', 'totalVehicles'));
}


    public function index()
{
    $loggedInUserId = auth()->id();
    $users = User::with('roles')
                 ->whereHas('roles', function ($query) {
                     $query->where('name', 'customer');
                 })
                 ->where('id', '!=', $loggedInUserId)
                 ->paginate(10);

    return view('agent.users.index', compact('users'));
}

public function getAllBookings()
{
    $bookings = Booking::all();
    return view('agent.bookingapprove', compact('bookings'));
}


public function updateBookingStatus(Request $request, $id)
{
    $request->validate([
        'booking_status' => 'required|in:approved,rejected',
    ]);

    $booking = Booking::findOrFail($id);
    $booking->status = $request->status;
    $booking->save();

    return redirect()->back()->with('success', 'Booking status updated successfully.');
}

}
