@extends('layouts.main')

@section('container')

<!-- Hero Section -->
<section class="min-vh-100 d-flex align-items-center text-white" style="background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)), url('/img/barbershop.jpg') center/cover no-repeat;">
    <div class="container text-center">
        <h1 class="display-3 fw-bold mb-3" data-aos="fade-down">Barber Royale</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">Pengalaman potong rambut terbaik untuk pria modern.</p>
        <a href="/bookings" class="btn btn-primary btn-lg mt-3" data-aos="zoom-in" data-aos-delay="400">Booking Sekarang</a>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5" data-aos="fade-up">Layanan Unggulan</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-right">
                <div class="card border-0 shadow h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-scissors fs-1 text-primary mb-3"></i>
                        <h5 class="card-title">Haircut</h5>
                        <p class="card-text">Potongan terbaik sesuai gaya dan bentuk wajahmu.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-person-gear fs-1 text-success mb-3"></i>
                        <h5 class="card-title">Beard Trim</h5>
                        <p class="card-text">Janggut rapi, tampil maskulin dan berkelas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-left">
                <div class="card border-0 shadow h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-droplet fs-1 text-danger mb-3"></i>
                        <h5 class="card-title">Creambath</h5>
                        <p class="card-text">Perawatan rambut agar tetap sehat, segar dan berkilau.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4" data-aos="fade-up">Tentang Kami</h2>
        <div class="row align-items-center">
            <div class="col-md-4 mb-4" data-aos="zoom-in-right">
              <img src="/img/barber-royale.png" class="img-fluid rounded shadow" alt="Tentang Kami" style="max-width: 300px; width: 100%;">
            </div>
            <div class="col-md-8" data-aos="fade-left">
                <p class="lead">Barber Royale menggabungkan seni barber klasik dengan sentuhan modern. Kami hadir untuk para pria yang mengutamakan penampilan dan kenyamanan.</p>
                <ul class="list-unstyled">
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Barber profesional & ramah</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Tempat nyaman & bersih</li>
                    <li><i class="bi bi-check-circle-fill text-success me-2"></i> Booking online mudah</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-dark text-white text-center py-5" data-aos="zoom-in">
    <div class="container">
        <h3 class="mb-3">Siap Tampil Lebih Ganteng?</h3>
        <a href="/bookings" class="btn btn-primary btn-lg">Booking Sekarang</a>
    </div>
</section>

@endsection
