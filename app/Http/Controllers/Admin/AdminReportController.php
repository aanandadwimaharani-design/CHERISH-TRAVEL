<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Airline;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('airline_id')) {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pemesanan', $request->status);
        }

        $bookings = $query->latest('created_at')->get();

        $totalRevenue = $bookings
            ->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->sum('total_harga');

        $airlines = Airline::orderBy('nama_maskapai', 'asc')->get();
        $statuses = ['Terkonfirmasi', 'Lunas', 'Dibatalkan'];

        return view('admin.reports.index', compact(
            'bookings',
            'totalRevenue',
            'airlines',
            'statuses',
            'request'
        ));
    }

    public function print(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('airline_id')) {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pemesanan', $request->status);
        }

        $bookings = $query->latest('created_at')->get();
        $totalRevenue = $bookings
            ->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->sum('total_harga');

        $pdf = Pdf::loadView('admin.reports.print', compact('bookings', 'totalRevenue', 'request'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-pemesanan-' . Carbon::now()->format('Ymd_His') . '.pdf');
    }

    public function excel(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('airline_id')) {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pemesanan', $request->status);
        }

        $bookings = $query->latest('created_at')->get();
        $totalRevenue = $bookings
            ->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->sum('total_harga');

        return Excel::download(new \App\Exports\BookingsExport($bookings, $totalRevenue),
            'laporan-pemesanan-' . Carbon::now()->format('Ymd_His') . '.xlsx');
    }
}
