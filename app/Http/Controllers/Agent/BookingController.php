<?php

namespace App\Http\Controllers\agent;

use App\Models\User;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function create()
    {
        // $customers = User::all();
        $vehicles = Vehicle::all();
        $locations = locations::all();

        return view('customers.bookings.create', compact('vehicles', 'locations'));
    }

    public function index()
    {
        $bookings = Booking::with(['vehicle'])->paginate(10); // Removed 'user' relationship

        return view('customers.bookings.index', compact('bookings'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'vehicle_id' => 'required|exists:vehicles,id',
            'pickup_location_id' => 'required|exists:locations,id',
            'return_location_id' => 'required|exists:locations,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,completed',
        ]);

        Booking::create($request->all() + ['booking_status' => 'pending']);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
{
    $booking = Booking::findOrFail($id);
    $vehicles = Vehicle::all();
    $locations = locations::all();
    return view('customers.bookings.edit', compact('booking', 'vehicles', 'locations'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'customer_name' => 'required|string|max:255',
        'vehicle_id' => 'required|exists:vehicles,id',
        'pickup_location_id' => 'required|exists:locations,id',
        'return_location_id' => 'required|exists:locations,id',
        'pickup_date' => 'required|date',
        'return_date' => 'required|date',
        'total_amount' => 'required|numeric|min:0',
        'booking_status' => 'required|in:pending,confirmed,canceled',
        'payment_status' => 'required|in:pending,paid',
    ]);

    $booking = Booking::findOrFail($id);

    $booking->update([
        'customer_name' => $request->customer_name,
        'vehicle_id' => $request->vehicle_id,
        'pickup_location_id' => $request->pickup_location_id,
        'return_location_id' => $request->return_location_id,
        'pickup_date' => $request->pickup_date,
        'return_date' => $request->return_date,
        'total_amount' => $request->total_amount,
        'booking_status' => $request->booking_status,
        'payment_status' => $request->payment_status,
    ]);

    return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
}


public function destroy($id)
{
    $user = Booking::findOrFail($id);
    $user->delete();
    return redirect()->route('bookings.index')->with('success', 'Booking Deleted Successfully');
}


}
