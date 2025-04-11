@extends('layouts.main')

@section('container')

@if(session()->has('success'))
  <div class="alert alert-success col-lg-8" role="alert">
    {{ session('success') }}
  </div>
@endif

<div class="container my-5">
  <h2 class="text-center mb-4">Our Services</h2>

  @if($services->count() > 0)
  <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
      <!-- Carousel indicators -->
      <div class="carousel-indicators">
          @foreach($services as $index => $service)
              <button type="button" data-bs-target="#serviceCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
          @endforeach
      </div>

      <!-- Carousel items -->
      <div class="carousel-inner">
          @foreach($services as $index => $service)
          <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
              <img src="{{ asset('img/services/' . $service->image) }}" class="d-block w-100" alt="{{ $service->name }}" style="height: 400px; object-fit: cover;">
              <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                  <h5>{{ $service->name }}</h5>
                  <p>{{ Str::limit($service->description, 120) }}</p>
                  <a href="{{ route('user.service.show', $service->id) }}" class="btn btn-primary">View Details</a>
              </div>
          </div>
          @endforeach
      </div>

      <!-- Navigation -->
      <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>
  @else
      <p class="text-center">No services available.</p>
  @endif
</div>

<!-- Book appointment button -->
<div class="text-center">
  <button class="btn btn-danger fs-5 my-2 mb-5">
      <a class="text-light heading p-3 text-decoration-none fw-normal" href="{{ route('bookings.create') }}">Book Appointment</a>
  </button>
</div>

<!-- Display bookings -->
{{-- <div class="container-fluid bg-light p-5">
  <div class="container">
      <div class="row">
        @forelse($bookings->where('status', 'Ongoing') as $index => $booking)
        <div class="col-md-6 p-3">
            <div class="card mb-3" style="max-width: 600px;">
                <div class="card-body text-start">
                    <!-- Display booking details -->
                    <h5 class="card-title">Booking {{ $index+1 }}</h5>
                    <p class="card-text">Barber: {{ optional($booking->barber)->name ?? 'Not Assigned' }}</p>
                    <p class="card-text">Service: {{ optional($booking->service)->name ?? 'Not Assigned' }}</p>
                    <p class="card-text">Date: {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, j M Y') }}</p>
                    <p class="card-text">Time: {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</p>
                    <p class="card-text">
                        Status: 
                        @if($booking->status == 'Ongoing')
                            <span class="badge bg-primary">Ongoing</span>
                        @endif
                    </p>
                    
                    <!-- Button to redirect to payment page -->
                    @if($booking->status == 'Ongoing')
                        <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-warning">Selesaikan Pembayaran</a>
                        <!-- Cancel button to cancel the booking -->
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Cancel</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="heading text-dark text-center display-5 pb-3">No Ongoing Appointments found.</p>
    @endforelse
    
      </div>
  </div>
</div> --}}




@endsection
