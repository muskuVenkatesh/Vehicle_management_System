<?php

namespace App\Http\Controllers\driver;

use App\Models\Ride;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $driverId = $user->id;

        $assignedRides = Ride::where('driver_id', $driverId)->get();

        $totalRides = $assignedRides->count();
        $scheduledRides = $assignedRides->where('ride_status', 'scheduled')->count();
        $ongoingRides = $assignedRides->where('ride_status', 'ongoing')->count();
        $completedRides = $assignedRides->where('ride_status', 'completed')->count();
        $cancelledRides = $assignedRides->where('ride_status', 'cancelled')->count();

        return view('driver.dashboard', compact('assignedRides', 'totalRides', 'scheduledRides', 'ongoingRides', 'completedRides', 'cancelledRides'));
    }

    public function assignedBookings()
{
    $user = auth()->user();
    $assignedRides = Ride::where('driver_id', $user->id)->get();

    return view('driver.assigned_bookings', compact('assignedRides'));
}

public function manageTrips()
{
    $user = auth()->user();
    $rides = Ride::where('driver_id', $user->id)->get();

    return view('driver.manage_trips', compact('rides'));
}



}
