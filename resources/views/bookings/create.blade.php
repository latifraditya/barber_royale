<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barber Royale | Bookings</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

    <div class="container-fluid py-5">
        <div class="container d-flex justify-content-center">
            <div class="row bg-dark text-white p-5 rounded-3 shadow-lg">
                <div class="col-12 text-center">
                    <h3 class="display-5 mb-4">
                        Book an <strong class="text-danger fw-bold">Appointment</strong>
                    </h3>
                    <form method="POST" action="{{ route('bookings.store') }}" enctype="multipart/form-data" class="fs-5 heading">
                        @csrf
                        <!-- Date input -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}"/>

                            @error('date')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Time input -->
                        <div class="mb-3">
                            <label for="time" class="form-label">Time</label>
                            <input type="time" class="form-control" name="time" value="{{ old('time') }}"/>

                            @error('time')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Barber selection -->
                        <div class="mb-3">
                            <label for="barber_id" class="form-label">Barber</label>
                            <select name="barber_id" class="form-select">
                                @foreach ($barbers as $barber)
                                    <option value="{{ $barber->id }}" {{ (old('barber_id') == $barber->id) ? 'selected' : '' }}>
                                        {{ $barber->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('barber_id')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Service selection -->
                        <div class="mb-3">
                            <label for="services_id" class="form-label">Type of Service</label>
                            <select name="services_id" class="form-select">
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}" {{ (old('services_id') == $service->id) ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('services_id')
                                <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                       <!-- Menu selection -->
                       <div class="mb-4">
                        <label for="menu_id" class="form-label">Select Menu (Optional)</label>
                        <select name="menu_id" class="form-select" id="menu_id">
                            <option value="">Select a Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" {{ old('menu_id') == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->name }} - Rp{{ number_format($menu->price) }}
                                </option>
                            @endforeach
                        </select>

                          @error('menu_id')
                              <p class="text-danger mt-1">{{ $message }}</p>
                          @enderror
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-danger fs-5 w-100 py-3">
                            Book Appointment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>
