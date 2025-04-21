<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\BarberController as AdminBarberController;
use App\Http\Controllers\User\ServicesController as UserServicesController;
use App\Http\Controllers\User\BarberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// ******
// Registration
// ******
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

//******
// Login
//******
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//******
// Booking
//******
Route::prefix('bookings')->group(function () {
    Route::get('/', [BookingController::class, 'index'])->name('bookings.index')->middleware(['auth']);
    Route::post('/', [BookingController::class, 'store'])->name('bookings.store')->middleware(['auth']);
    Route::get('/create', [BookingController::class, 'create'])->name('bookings.create')->middleware(['auth']);
    Route::get('/history', [BookingController::class, 'history'])->name('bookings.history'); 
    Route::put('{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// /* User Routes */
// Route::resource('user/services', UserServicesController::class)->names('user.services');

// Route::resource('user/bookings', UserBookingController::class)->names('user.bookings');

// Route::resource('user/barbers', UserBarberController::class)->names('user.barbers');


// Admin Service
Route::middleware(['admin'])->group(function () {
    // Rute untuk menampilkan halaman layanan
    Route::get('/admin/services', [ServicesController::class, 'index'])->name('admin.services.index');
    
    // Rute untuk menampilkan form tambah layanan
    Route::get('/admin/services/create', [ServicesController::class, 'create'])->name('admin.services.create');

    // Rute untuk menyimpan layanan baru
    Route::post('/admin/services', [ServicesController::class, 'store'])->name('admin.services.store');
    
    // Rute untuk menampilkan form edit layanan
    Route::get('/admin/services/{service}/edit', [ServicesController::class, 'edit'])->name('admin.services.edit');
    
    // Rute untuk memperbarui layanan
    Route::put('/admin/services/{service}', [ServicesController::class, 'update'])->name('admin.services.update');
    
    // Rute untuk menghapus layanan
    Route::delete('/admin/services/{service}', [ServicesController::class, 'destroy'])->name('admin.services.destroy');
});

// User Service

    Route::get('services', [UserServicesController::class, 'index'])->name('user.services.index');
    
    // Route to show details of a single service for users
    Route::get('service/{service}', [UserServicesController::class, 'show'])->name('user.service.show');


// Admin Barber
Route::middleware(['admin'])->group(function () {
  Route::resource('/admin/barbers', AdminBarberController::class)->names('admin.barbers');
});

// Barber
Route::get('barbers', [BarberController::class, 'index'])->name('user.barbers.index');
  
// Route to show details of a single barber
Route::get('barber/{barber}', [BarberController::class, 'show'])->name('user.barber.show');


Route::get('payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('payment/{booking}/complete', [PaymentController::class, 'complete'])->name('payment.complete');


// Admin Dashboard

Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
