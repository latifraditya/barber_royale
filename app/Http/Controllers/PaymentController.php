<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
  public function show(Booking $booking)
  {
      // Pastikan booking statusnya Ongoing
      if ($booking->status !== 'Ongoing') {
          return redirect()->route('bookings.index')->with('error', 'Booking tidak valid untuk pembayaran.');
      }

      // Tampilkan halaman pembayaran
      return view('payment.show', compact('booking'));
  }

  // Menyelesaikan pembayaran dan mengubah status booking menjadi Selesai
  public function complete(Booking $booking)
  {
      // Pastikan booking statusnya Ongoing
      if ($booking->status === 'Ongoing') {
          $booking->status = 'Selesai';
          $booking->save();
      }

      // Redirect kembali ke halaman daftar booking
      return redirect()->route('bookings.history')->with('success', 'Pembayaran selesai, booking berhasil diselesaikan.');
  }
}
