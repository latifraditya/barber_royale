@extends('layouts.main')

@section('container')
<div class="container">
    <h1>{{ $service->name }}</h1>

    <div class="row">
        <div class="col-md-12">
            <p><strong>Description:</strong> {{ $service->description }}</p>
        </div>
    </div>

    <a href="{{ route('user.services.index') }}" class="btn btn-secondary mt-3">Back to Services</a>
</div>
@endsection
