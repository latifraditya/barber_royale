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
  public function complete(Request $request, Booking $booking)
  {
      $request->validate([
          'payment_method' => 'required|string',
      ]);

      if ($booking->status === 'Ongoing') {

          // Hitung total harga layanan dan menu
          $servicePrice = optional($booking->service)->price ?? 0;
          $menuPrice = optional($booking->menu)->price ?? 0;
          $total = $servicePrice + $menuPrice;

          // Update data booking
          $booking->status = 'Selesai';
          $booking->payment_method = $request->payment_method;
          $booking->payment_amount = $total;
          $booking->save();
      }
      dd([
        'service' => $booking->service,
        'menu' => $booking->menu,
        'service_price' => optional($booking->service)->price,
        'menu_price' => optional($booking->menu)->price,
        'total' => $total,
    ]);
    

      return redirect()->route('bookings.history')->with('success', 'Pembayaran selesai, booking berhasil diselesaikan.');
  }


}
