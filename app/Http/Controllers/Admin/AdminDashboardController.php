<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\User;
use App\Models\Passenger;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $bookingsToday = Booking::whereDate('created_at', Carbon::today())->count();
        $totalPassengers = Passenger::count();
        $totalRevenue = Booking::where('status_pemesanan', 'Terkonfirmasi')
            ->orWhere('status_pemesanan', 'Lunas')
            ->sum('total_harga');
        $totalFlights = Flight::where('status', '!=', 'Dibatalkan')->count();
        $availableFlights = Flight::where('status', 'Tersedia')->count();

        $bookingStatuses = Booking::select('status_pemesanan', DB::raw('count(*) as jumlah'))
            ->groupBy('status_pemesanan')
            ->orderByDesc('jumlah')
            ->get();

        $bookingsPerMonth = Booking::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('YEAR(created_at) as tahun'),
            DB::raw('count(*) as jumlah')
        )
        ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
        ->groupBy('tahun', 'bulan')
        ->orderBy('tahun', 'asc')
        ->orderBy('bulan', 'asc')
        ->get()
        ->map(function ($row) {
            return [
                'bulan' => Carbon::create($row->tahun, $row->bulan, 1)->translatedFormat('M Y'),
                'jumlah' => (int) $row->jumlah,
            ];
        });

        $revenuePerMonth = Booking::whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('sum(total_harga) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get()
            ->map(function ($row) {
                return [
                    'bulan' => Carbon::create($row->tahun, $row->bulan, 1)->translatedFormat('M Y'),
                    'total' => (float) $row->total,
                ];
            });

        $recentBookings = Booking::with(['flight.airline', 'flight.origin', 'flight.destination'])
            ->latest('created_at')
            ->limit(10)
            ->get();

        $topAirlines = Booking::with('flight.airline')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->join('airlines', 'flights.airline_id', '=', 'airlines.id')
            ->select('airlines.nama_maskapai', DB::raw('count(*) as jumlah'))
            ->groupBy('airlines.nama_maskapai')
            ->orderByDesc('jumlah')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'bookingsToday',
            'totalPassengers',
            'totalRevenue',
            'totalFlights',
            'availableFlights',
            'bookingStatuses',
            'bookingsPerMonth',
            'revenuePerMonth',
            'recentBookings',
            'topAirlines'
        ));
    }
}
