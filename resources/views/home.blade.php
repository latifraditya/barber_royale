@extends('layouts.main')

@section('container')

<!-- Header Section -->
<header class="bg-dark text-white text-center py-5">
    <div class="container">
        <h1 class="display-4">Selamat Datang di Barber Royale</h1>
        <p class="lead">Pengalaman potong rambut terbaik yang pernah ada.</p>
    </div>
</header>

<!-- Call-to-Action Section -->

<div class="text-center mt-3 mb-4">
    <a href="/bookings" class="btn btn-primary mb-3">
        Booking Sekarang
    </a>
</div>

<!-- About Section -->
<section class="container my-5">
    <h2 class="text-center mb-4">Tentang Barber Royale</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="/img/barbershop.png" class="img-fluid rounded" alt="Barber Royale" />
        </div>
        <div class="col-md-6">
            <p class="lead">Di Barber Royale, kami memberikan layanan potong rambut dan perawatan rambut terbaik. Kami memiliki tim barbers profesional yang siap memberikan layanan terbaik untuk membuat tampilanmu semakin fresh dan stylish. Kami menyediakan berbagai layanan, mulai dari potong rambut, trim janggut, hingga creambath yang membuat rambut kamu lebih sehat dan berkilau.</p>
            <p>Datang dan rasakan sendiri pengalaman berbeda bersama kami.</p>
        </div>
    </div>
</section>

@endsection
