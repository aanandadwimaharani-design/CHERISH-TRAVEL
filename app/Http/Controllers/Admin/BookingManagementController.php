<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Airline;
use Illuminate\Http\Request;

class BookingManagementController extends Controller
{
    /**
     * Menampilkan seluruh data pemesanan
     */
    public function index(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination', 'passengers']);

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_booking', 'like', "%{$search}%")
                  ->orWhere('nama_pemesan', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nomor_hp', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status_pemesanan', $request->status);
        }

        // Filter maskapai
        if ($request->filled('airline_id') && $request->airline_id !== 'all') {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }

        // Filter tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $bookings = $query->orderByDesc('created_at')->paginate(15)->withQueryString();
        $airlines = Airline::orderBy('nama_maskapai')->get();

        return view('admin.bookings.index', compact('bookings', 'airlines'));
    }

    /**
     * Menampilkan detail pemesanan
     */
    public function show($id)
    {
        $booking = Booking::with([
            'flight.airline',
            'flight.origin',
            'flight.destination',
            'passengers'
        ])->findOrFail($id);

        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Mengubah status pemesanan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pemesanan' => 'required|in:Terkonfirmasi,Lunas,Dibatalkan,Pending',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'status_pemesanan' => $request->status_pemesanan,
        ]);

        return back()->with('success', "Status pemesanan {$booking->kode_booking} berhasil diubah menjadi {$request->status_pemesanan}.");
    }
}
