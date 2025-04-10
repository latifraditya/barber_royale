@extends('layouts.main')

@section('container')
<div class="container">
    <h1>Our Services</h1>

    <div class="row">
        @foreach($services as $service)
            <div class="col-md-4 mb-4">
                <!-- Service card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                        <a href="{{ route('user.service.show', $service->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
