<?php

namespace App\Models;

use App\Models\User;
use App\Models\locations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'vehicle_id',
        'pickup_location_id',
        'return_location_id',
        'pickup_date',
        'return_date',
        'booking_status',
        'total_amount',
        'payment_status',
    ];


    // public function customer()
    // {
    //     return $this->belongsTo(User::class);
    // }

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
        return $this->belongsTo(locations::class, 'pickup_location_id');
    }

    /**
     * Get the return location.
     */
    public function returnLocation()
    {
        return $this->belongsTo(locations::class, 'return_location_id');
    }
}
