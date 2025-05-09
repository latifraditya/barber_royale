<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
      'booking_id',
      'total_before_tax',
      'tax_percentage',
      'total_after_tax',
    ];
    
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
