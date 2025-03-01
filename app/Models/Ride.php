<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'booking_id',
        'status',
        'start_time',
        'end_time',
        'pickup_location',
        'dropoff_location',
        'fare',
    ];


    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }


    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
