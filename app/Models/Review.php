<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'customer_id',
        'vehicle_id',
        'rating',
        'comment',
        'review_date',
    ];

    /**
     * Get the booking associated with the review.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the customer who wrote the review.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the vehicle being reviewed.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
