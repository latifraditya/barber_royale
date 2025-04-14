<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- font blog logo --}}
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    {{-- My Style --}}
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    

    <title> Barber Royale</title>
  </head>
<body>

    @include('partials.navbar')
   
<div class="container mt-4">
    @yield('container')
</div>
 <!-- Footer -->
 <footer class="bg-dark text-white mt-5">
  <div class="container-fluid py-4 px-5">
      <div class="row text-center text-md-start">
          <div class="col-md-4 mb-3">
              <h5><i class="bi bi-geo-alt-fill"></i> Alamat</h5>
              <p>Jl. Raya Panglima Polim No. 25, Jakarta Selatan, Indonesia</p>
          </div>
          <div class="col-md-4 mb-3">
              <h5><i class="bi bi-clock-fill"></i> Jam Buka</h5>
              <p>Senin - Jumat: 10.00 - 20.00<br>Sabtu - Minggu: 09.00 - 22.00</p>
          </div>
          <div class="col-md-4 mb-3">
              <h5><i class="bi bi-c-circle"></i> Hak Cipta</h5>
              <p>&copy; {{ date('Y') }} Barber Royale. All rights reserved.</p>
          </div>
      </div>
  </div>
</footer>
  {{-- JS Script --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  
</body>
</html>
