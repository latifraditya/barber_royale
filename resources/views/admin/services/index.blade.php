@extends('layouts.main')

@section('container')
    <h2>Manage Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Add Service</a>

    @if(session()->has('success'))
    <div class="alert alert-success col-lg-8" role="alert">
      {{ session('success') }}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td class="col-lg-8">{{ $service->description }}</td>
                    <td>{{ $service->price }}</td>
                    <td>
                      <div class="d-flex justify-content-start">
                          <!-- Edit Button -->
                          <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning mr-3" title="Edit">
                              <i class="fas fa-edit fa-sm"></i> <!-- Reduced Icon Size -->
                          </a>
                          
                          <!-- Delete Button -->
                          <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;" data-service-id="{{ $service->id }}" onsubmit="return confirmDelete(event)">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" title="Delete">
                                  <i class="fas fa-trash-alt fa-sm"></i> <!-- Reduced Icon Size -->
                              </button>
                          </form>
                      </div>
                  </td>                               
                </tr>
            @endforeach
        </tbody>
    </table>


<script>
    function confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this service?')) {
            event.preventDefault(); // Prevent form submission if the user cancels
        }
    }
</script>
@endsection
