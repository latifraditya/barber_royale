<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Booking;

class PaymentController extends Controller
{
  public function show(Booking $booking)
  {
      if ($booking->status !== 'Ongoing') {
          return redirect()->route('bookings.index')->with('error', 'Booking tidak valid untuk pembayaran.');
      }

      // Ambil relasi transaksi dan detail
      $booking->load(['barber', 'transaction.details']);

      // Pastikan transaksi tersedia
      $transaction = $booking->transaction;
      if (!$transaction) {
          return redirect()->route('bookings.index')->with('error', 'Transaksi tidak ditemukan.');
      }

      $transactionDetails = $transaction->details;

      return view('payment.show', compact('booking', 'transaction', 'transactionDetails'));
  }


  // Menyelesaikan pembayaran dan mengubah status booking menjadi Selesai
  public function complete(Request $request, Booking $booking)
  {
      // $request->validate([
      //     'payment_method' => 'required|string',
      // ]);

      if ($booking->status === 'Ongoing') {

          // Hitung total harga layanan dan menu
          $servicePrice = optional($booking->service)->price ?? 0;
          $menuPrice = optional($booking->menu)->price ?? 0;
          $total = $servicePrice + $menuPrice;

          // Update data booking
          $booking->status = 'Selesai';
          $booking->payment_amount = $total;
          $booking->save();
      }
    

      return redirect()->route('bookings.history')->with('success', 'Pembayaran selesai, booking berhasil diselesaikan.');
  }

  public function receipt(Booking $booking)
  {
      if ($booking->status !== 'Selesai') {
          return redirect()->route('bookings.history')->with('error', 'Struk hanya tersedia untuk booking yang sudah selesai.');
      }

      $booking->load(['barber', 'transaction.details']);
      $transaction = $booking->transaction;

      if (!$transaction) {
          return redirect()->route('bookings.history')->with('error', 'Transaksi tidak ditemukan.');
      }

      $transactionDetails = $transaction->details;

      return view('payment.receipt', compact('booking', 'transaction', 'transactionDetails'));
  }



}
