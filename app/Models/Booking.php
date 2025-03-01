<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'pickup_location_id',
        'return_location_id',
        'pickup_date',
        'return_date',
        'booking_status',
        'total_amount',
        'payment_status',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the vehicle for this booking.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the pickup location.
     */
    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    /**
     * Get the return location.
     */
    public function returnLocation()
    {
        return $this->belongsTo(Location::class, 'return_location_id');
    }
}
