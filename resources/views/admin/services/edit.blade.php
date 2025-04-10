@extends('layouts.main')

@section('container')
    <h2>Edit Service</h2>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $service->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Service Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('storage/' . $service->image) }}" alt="current image" class="mt-2" width="100">
        </div>

        <button type="submit" class="btn btn-success">Update Service</button>
    </form>
@endsection
