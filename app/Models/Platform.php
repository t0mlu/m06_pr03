<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'owner'
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
