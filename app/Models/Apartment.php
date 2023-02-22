<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'address',
        'city',
        'postal_code',
        'rented_price',
        'rented',
        'user_id'
    ];
}
