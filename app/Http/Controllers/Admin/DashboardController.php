<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Passenger;
use App\Models\Flight;
use App\Models\Airline;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Dashboard Admin - Menampilkan ringkasan statistik
     */
    public function index()
    {
        // Total seluruh pemesanan
        $totalBookings = Booking::count();

        // Jumlah pemesanan hari ini
        $todayBookings = Booking::whereDate('created_at', Carbon::today())->count();

        // Jumlah seluruh penumpang
        $totalPassengers = Passenger::count();

        // Total pendapatan (hanya dari pemesanan Terkonfirmasi/Lunas)
        $totalRevenue = Booking::whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->sum('total_harga');

        // Jumlah penerbangan tersedia
        $availableFlights = Flight::where('status', 'Tersedia')
            ->where('tanggal_keberangkatan', '>=', Carbon::today())
            ->count();

        // Total maskapai
        $totalAirlines = Airline::count();

        // Pemesanan terbaru (10 terakhir)
        $recentBookings = Booking::with(['flight.airline', 'flight.origin', 'flight.destination'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // Statistik status pemesanan
        $bookingStats = [
            'terkonfirmasi' => Booking::where('status_pemesanan', 'Terkonfirmasi')->count(),
            'lunas' => Booking::where('status_pemesanan', 'Lunas')->count(),
            'dibatalkan' => Booking::where('status_pemesanan', 'Dibatalkan')->count(),
            'pending' => Booking::where('status_pemesanan', 'Pending')->count(),
        ];

        // Pendapatan bulan ini
        $monthlyRevenue = Booking::whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_harga');

        return view('admin.dashboard', compact(
            'totalBookings',
            'todayBookings',
            'totalPassengers',
            'totalRevenue',
            'availableFlights',
            'totalAirlines',
            'recentBookings',
            'bookingStats',
            'monthlyRevenue'
        ));
    }
}
