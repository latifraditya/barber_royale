@extends('layouts.main')

@section('container')
<div class="container">
    <h1>Our Barbers</h1>

    <div class="row">
        @foreach($barbers as $barber)
            <div class="col-md-4 mb-4">
                <!-- Barber card -->
                <div class="card">
                    <!-- Tampilkan gambar dari database -->
                    <img src="{{ asset($barber->image_url) }}" class="card-img-top" alt="Barber Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $barber->name }}</h5>
                        <a href="{{ route('admin.barbers.show', $barber->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
