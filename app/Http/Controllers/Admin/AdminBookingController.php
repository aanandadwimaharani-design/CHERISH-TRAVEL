<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination', 'passengers']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhere('nama_pemesan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status_pemesanan', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $bookings = $query->latest('created_at')->paginate(15)->appends($request->query());

        $statuses = ['Terkonfirmasi', 'Lunas', 'Dibatalkan'];

        return view('admin.bookings.index', compact('bookings', 'statuses'));
    }

    public function show($kode_booking)
    {
        $booking = Booking::with([
            'flight.airline',
            'flight.origin',
            'flight.destination',
            'passengers',
        ])->where('kode_booking', $kode_booking)->firstOrFail();

        $qrData = route('ticket.show', ['kode_booking' => $booking->kode_booking]);

        return view('admin.bookings.show', compact('booking', 'qrData'));
    }
}
