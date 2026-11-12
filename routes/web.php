<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminFlightController;
use App\Http\Controllers\Admin\AdminAirlineController;
use App\Http\Controllers\Admin\AdminAirportController;
use App\Http\Controllers\Admin\AdminReportController;

/*
|--------------------------------------------------------------------------
| Web Routes - CHERISH TRAVEL
|--------------------------------------------------------------------------
*/

// Halaman Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman Hasil Pencarian Penerbangan
Route::get('/penerbangan', [FlightController::class, 'index'])->name('flights.index');

// Halaman Booking / Pemesanan
Route::get('/booking/{flight_id}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Halaman E-Ticket
Route::get('/tiket/{kode_booking}', [TicketController::class, 'show'])->name('ticket.show');

// ============================================================================
// HALAMAN ADMIN - CHERISH TRAVEL DASHBOARD
// ============================================================================

// Autentikasi Admin (tanpa middleware admin, controller menangani status auth)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');

// Halaman Admin yang dilindungi middleware admin
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Utama
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Logout Admin
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Manajemen Pemesanan
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{kode_booking}', [AdminBookingController::class, 'show'])->name('bookings.show');

    // Manajemen Penerbangan
    Route::get('/flights', [AdminFlightController::class, 'index'])->name('flights.index');
    Route::get('/flights/create', [AdminFlightController::class, 'create'])->name('flights.create');
    Route::post('/flights', [AdminFlightController::class, 'store'])->name('flights.store');
    Route::get('/flights/{flight}/edit', [AdminFlightController::class, 'edit'])->name('flights.edit');
    Route::put('/flights/{flight}', [AdminFlightController::class, 'update'])->name('flights.update');
    Route::delete('/flights/{flight}', [AdminFlightController::class, 'destroy'])->name('flights.destroy');

    // Manajemen Maskapai
    Route::get('/airlines', [AdminAirlineController::class, 'index'])->name('airlines.index');
    Route::get('/airlines/create', [AdminAirlineController::class, 'create'])->name('airlines.create');
    Route::post('/airlines', [AdminAirlineController::class, 'store'])->name('airlines.store');
    Route::get('/airlines/{airline}/edit', [AdminAirlineController::class, 'edit'])->name('airlines.edit');
    Route::put('/airlines/{airline}', [AdminAirlineController::class, 'update'])->name('airlines.update');
    Route::delete('/airlines/{airline}', [AdminAirlineController::class, 'destroy'])->name('airlines.destroy');

    // Manajemen Bandara
    Route::get('/airports', [AdminAirportController::class, 'index'])->name('airports.index');
    Route::get('/airports/create', [AdminAirportController::class, 'create'])->name('airports.create');
    Route::post('/airports', [AdminAirportController::class, 'store'])->name('airports.store');
    Route::get('/airports/{airport}/edit', [AdminAirportController::class, 'edit'])->name('airports.edit');
    Route::put('/airports/{airport}', [AdminAirportController::class, 'update'])->name('airports.update');
    Route::delete('/airports/{airport}', [AdminAirportController::class, 'destroy'])->name('airports.destroy');

    // Laporan Pemesanan
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print', [AdminReportController::class, 'print'])->name('reports.print');
    Route::get('/reports/excel', [AdminReportController::class, 'excel'])->name('reports.excel');
});
