<?php

namespace App\Models;

use App\Models\User;
use App\Models\Barber;
use App\Models\Services;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_date',
        'booking_time',
        'barber_id',
        'services_id',
        'user_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'services_id');
    }
}
