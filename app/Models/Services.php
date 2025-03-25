<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function barber() {
      return $this->belongsToMany(Barber::class)->withTimestamps();
    }
}
