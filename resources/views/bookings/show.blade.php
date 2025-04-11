@extends('layouts.main')

@section('container')
<div class="container my-5">
    <h2>Booking Details</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Booking #{{ $booking->id }}</h5>
            <p class="card-text"><strong>Barber:</strong> {{ $booking->barber->name ?? 'Not Assigned' }}</p>
            <p class="card-text"><strong>Service:</strong> {{ $booking->service->name ?? 'Not Assigned' }}</p>
            <p class="card-text"><strong>Date:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, j M Y') }}</p>
            <p class="card-text"><strong>Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</p>
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Edit Booking</a>
            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancel Booking</button>
            </form>
        </div>
    </div>
</div>
@endsection
