@extends('layouts.main')

@section('container')
<div class="container">
    <h1>{{ $barber->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <img src="https://via.placeholder.com/300" class="img-fluid" alt="Barber Image">
        </div>
        <div class="col-md-6">
            <p><strong>Phone Number:</strong> {{ $barber->phone_number }}</p>
        </div>
    </div>

    <a href="{{ route('user.barbers.index') }}" class="btn btn-secondary mt-3">Back to Barbers</a>
</div>
@endsection
