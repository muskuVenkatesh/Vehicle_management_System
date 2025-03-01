<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locations extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'address',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
    ];
}
