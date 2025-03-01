<?php

namespace App\Http\Controllers\vehicle;

use App\Models\Vehicle;
use App\Models\locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
{
    
    $vehicles = Vehicle::all();

    return view('agent.vehicles.index', compact('vehicles'));
}

public function create()
{
    $locations = locations::all();
    return view('agent.vehicles.create', compact('locations'));
}




public function store(Request $request)
{
    $validatedData = $request->validate([
        'make'             => 'nullable|string|max:255',
        'model'            => 'required|string|max:255',
        'year'             => 'required|integer|min:1900|max:' . date('Y'),
        'vehicle_type'     => 'required|string|max:255',
        'color'            => 'required|string|max:255',
        'license_plate'    => 'nullable|string|max:50|unique:vehicles',
        'mileage'          => 'required|integer|min:0',
        'fuel_type'        => 'required|string|max:255',
        'engine_capacity'  => 'required|numeric|min:0',
        'seating_capacity' => 'required|integer|min:1',
        'availability'     => 'required|boolean',
        'daily_rate'       => 'required|numeric|min:0',
        'hourly_rate'      => 'required|numeric|min:0',
        'image_url'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description'      => 'nullable|string',
        'location_id'      => 'required|exists:locations,id',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image_url')->store('vehicle_images', 'public');
        $imagePath = Storage::url($imagePath);
    }

    $vehicle = Vehicle::create([
        'make'             => $validatedData['make'] ?? null,
        'model'            => $validatedData['model'],
        'year'             => $validatedData['year'],
        'vehicle_type'     => $validatedData['vehicle_type'],
        'color'            => $validatedData['color'],
        'license_plate'    => $validatedData['license_plate'] ?? null,
        'mileage'          => $validatedData['mileage'],
        'fuel_type'        => $validatedData['fuel_type'],
        'engine_capacity'  => $validatedData['engine_capacity'],
        'seating_capacity' => $validatedData['seating_capacity'],
        'availability'     => (bool) $validatedData['availability'],
        'daily_rate'       => $validatedData['daily_rate'],
        'hourly_rate'      => $validatedData['hourly_rate'],
        'image_url'        => $imagePath,
        'description'      => $validatedData['description'] ?? null,
        'location_id'      => $validatedData['location_id'],
    ]);

    return response()->json([
        'message' => 'Vehicle created successfully!',
        'vehicle' => $vehicle
    ], 201);
}

public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $locations = locations::all();
        return view('agent.vehicles.edit', compact('vehicle','locations'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'make'              => 'required|string|max:255',
            'model'             => 'required|string|max:255',
            'year'              => 'required|integer|min:1900|max:' . date('Y'),
            'vehicle_type'      => 'required|string|max:255',
            'color'             => 'nullable|string|max:255',
            'license_plate'     => 'required|string|max:255|unique:vehicles,license_plate,' . $id,
            'mileage'           => 'nullable|numeric|min:0',
            'fuel_type'         => 'required|string|max:255',
            'engine_capacity'   => 'nullable|numeric|min:0',
            'seating_capacity'  => 'required|integer|min:1',
            'availability'      => 'required|boolean',
            'daily_rate'        => 'nullable|numeric|min:0',
            'hourly_rate'       => 'nullable|numeric|min:0',
            'image_url'             => 'nullable|image|max:2048',
            'description'       => 'nullable|string',
            'location_id'       => 'required|exists:locations,id'
        ]);

        $vehicle = Vehicle::findOrFail($id);

        $vehicle->update([
            'make'             => $request->make,
            'model'            => $request->model,
            'year'             => $request->year,
            'vehicle_type'     => $request->vehicle_type,
            'color'            => $request->color,
            'license_plate'    => $request->license_plate,
            'mileage'          => $request->mileage,
            'fuel_type'        => $request->fuel_type,
            'engine_capacity'  => $request->engine_capacity,
            'seating_capacity' => $request->seating_capacity,
            'availability'     => $request->availability,
            'daily_rate'       => $request->daily_rate,
            'hourly_rate'      => $request->hourly_rate,
            'description'      => $request->description,
            'location_id'      => $request->location_id,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicles', 'public');
            $vehicle->image_url = '/storage/' . $imagePath;
            $vehicle->save();
        }

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully!');
    }

    public function destroy($id)
{
    $vehicle = Vehicle::find($id);

    if (!$vehicle) {
        return response()->json(['error' => 'Vehicle not found'], 404);
    }

    $vehicle->delete();

    return redirect()->route('vehicles.index')->with('success', 'User Deleted Successfully');
}
}
