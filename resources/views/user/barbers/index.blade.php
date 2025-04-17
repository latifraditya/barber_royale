@extends('layouts.main')

@section('container')
<div class="container my-5">
    <h2 class="text-center mb-4">Our Barbers</h2>

    @if($barbers->count() > 0)
    <div class="row g-4">
        @foreach($barbers as $barber)
        <div class="col-md-4" data-aos="fade-up">
            <div class="card h-100 border-0 shadow text-center">
                <img src="{{ asset('img/barbers/' . $barber->image) }}" class="card-img-top" alt="{{ $barber->name }}" style="height: 300px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $barber->name }}</h5>
                    <p class="card-text">{{ Str::limit($barber->bio, 100) }}</p>
                    <a href="{{ route('user.barber.show', $barber->id) }}" class="btn btn-outline-primary mt-2">View Profile</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-center">No barbers available at the moment.</p>
    @endif
</div>
@endsection
