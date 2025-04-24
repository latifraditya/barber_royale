@extends('layouts.main')

@section('container')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4>Booking Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>Status:</strong> <span class="badge bg-success">Selesai</span></p>
                    <p><strong>Barber:</strong> {{ optional($booking->barber)->name ?? 'Belum ditentukan' }}</p>
                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, j M Y') }}</p>
                    <p><strong>Waktu:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('H:i') }}</p>

                    <hr>
                    <h5>Detail Transaksi:</h5>
                    <ul class="list-group mb-3">
                        @foreach ($transactionDetails as $detail)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ ucfirst($detail->item_type) }}: {{ $detail->item_name }}</span>
                                <span class="text-end">Rp{{ number_format($detail->item_price, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Total Item</strong></span>
                            <span class="text-end">Rp{{ number_format($transaction->total_before_tax, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><strong>Pajak ({{ number_format($transaction->tax_percent * 100, 0) }}%)</strong></span>
                            <span class="text-end">
                                Rp{{ number_format($transaction->total_after_tax - $transaction->total_before_tax, 0, ',', '.') }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between fw-bold text-success">
                            <span>Total Bayar</span>
                            <span class="text-end">Rp{{ number_format($transaction->total_after_tax, 0, ',', '.') }}</span>
                        </li>
                    </ul>

                    <div class="text-center mt-4">
                        <a href="{{ route('bookings.history') }}" class="btn btn-secondary">Kembali ke Riwayat</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
