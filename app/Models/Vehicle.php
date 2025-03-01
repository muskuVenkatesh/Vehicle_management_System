<?php

namespace App\Models;

use App\Models\locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'make',
        'model',
        'year',
        'vehicle_type',
        'color',
        'license_plate',
        'mileage',
        'fuel_type',
        'engine_capacity',
        'seating_capacity',
        'availability',
        'daily_rate',
        'hourly_rate',
        'image_url',
        'description',
        'location_id',
    ];

    /**
     * Get the location associated with the vehicle.
     */
    public function location()
    {
        return $this->belongsTo(locations::class);
    }
}
