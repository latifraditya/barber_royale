@extends('layouts.main')

@section('container')

@if(session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
@endif

<!-- Section Booking History -->
<div class="container my-5">
    <h2 class="text-center mb-4">Booking History</h2>

    <!-- Filter Form -->
    <form action="{{ route('bookings.history') }}" method="GET" class="row g-3 mb-4 justify-content-center">
        <div class="col-md-4">
            <label for="status" class="form-label">Filter by Status</label>
            <select class="form-select" name="status" id="status" onchange="this.form.submit()">
                <option value="">--semua --</option>
                <option value="Ongoing" {{ request('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
    </form>

    <!-- Booking Cards -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($bookings as $index => $booking)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Booking #{{ $index + 1 }}</h5>
                    <p><strong>Barber:</strong> {{ optional($booking->barber)->name ?? 'Not Assigned' }}</p>
                    <p><strong>Service:</strong> {{ optional($booking->service)->name ?? 'Not Assigned' }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, j M Y') }}</p>
                    <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</p>
                    <p><strong>Menu:</strong> {{ optional($booking->menu)->name ?? '-' }}</p>


                    <p><strong>Status:</strong>
                        @if($booking->status == 'Ongoing')
                            <span class="badge bg-primary">Ongoing</span>
                        @elseif($booking->status == 'Selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($booking->status == 'Cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-secondary">Unknown</span>
                        @endif
                    </p>

                    @if($booking->status == 'Ongoing')
                        <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-warning mb-2 w-100">Selesaikan Pembayaran</a>
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger w-100">Cancel Booking</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <p class="text-center fs-4">No bookings found for this filter.</p>
        @endforelse
    </div>
</div>

@endsection
