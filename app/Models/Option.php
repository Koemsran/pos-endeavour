<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    //============= relationship =============================
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_options')
                    ->withPivot('qty')
                    ->withTimestamps();
    }
}
