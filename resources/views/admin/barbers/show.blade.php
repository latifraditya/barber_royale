@extends('layouts.main')

@section('container')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h4>Pembayaran Booking #{{ $booking->id }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Barber:</strong> {{ optional($booking->barber)->name ?? 'Belum ditentukan' }}</p>
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, j M Y') }}</p>
                    <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</p>

                    <hr>
                    <h5>Detail Transaksi:</h5>
                    <ul>
                        @foreach ($transactionDetails as $detail)
                            <li>
                                {{ ucfirst($detail->item_type) }}: {{ $detail->item_name }} - 
                                Rp{{ number_format($detail->item_price, 0, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>

                    <hr>
                    <p><strong>Total Sebelum Pajak:</strong> Rp{{ number_format($transaction->total_before_tax, 0, ',', '.') }}</p>
                    <p><strong>Pajak ({{ $transaction->tax_percent }}%):</strong> Rp{{ number_format($transaction->total_after_tax - $transaction->total_before_tax, 0, ',', '.') }}</p>
                    <p class="fs-5 fw-bold text-success">
                        Total Dibayar: Rp{{ number_format($transaction->total_after_tax, 0, ',', '.') }}
                    </p>

                    <form action="{{ route('payment.complete', $booking->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" name="payment_method" id="payment_method" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="OVO">OVO</option>
                                <option value="GoPay">GoPay</option>
                                <option value="DANA">DANA</option>
                                <option value="ShopeePay">ShopeePay</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                            <a href="{{ route('bookings.history') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
