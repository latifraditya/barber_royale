<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
      'transaction_id',     // ID transaksi yang menghubungkan dengan transaksi master
      'item_type',          // Jenis item (service atau menu)
      'item_id',            // ID item yang mengacu pada layanan atau menu
      'item_name',          // Nama item (misalnya: nama layanan atau menu)
      'item_price',         // Harga item (harga layanan atau menu)
    ];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

}
