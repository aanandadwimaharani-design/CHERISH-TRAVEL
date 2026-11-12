<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Airline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan pemesanan
     */
    public function index(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination', 'passengers']);

        // Filter tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter maskapai
        if ($request->filled('airline_id') && $request->airline_id !== 'all') {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }

        // Filter status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status_pemesanan', $request->status);
        }

        $bookings = $query->orderByDesc('created_at')->get();

        // Hitung total pendapatan (hanya transaksi berhasil)
        $totalRevenue = $bookings->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])->sum('total_harga');
        $totalTransactions = $bookings->count();
        $successTransactions = $bookings->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])->count();
        $cancelledTransactions = $bookings->where('status_pemesanan', 'Dibatalkan')->count();

        $airlines = Airline::orderBy('nama_maskapai')->get();

        return view('admin.reports.index', compact(
            'bookings',
            'totalRevenue',
            'totalTransactions',
            'successTransactions',
            'cancelledTransactions',
            'airlines'
        ));
    }

    /**
     * Cetak laporan (print-friendly view)
     */
    public function print(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination', 'passengers']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('airline_id') && $request->airline_id !== 'all') {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status_pemesanan', $request->status);
        }

        $bookings = $query->orderByDesc('created_at')->get();
        $totalRevenue = $bookings->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])->sum('total_harga');
        $totalTransactions = $bookings->count();

        return view('admin.reports.print', compact('bookings', 'totalRevenue', 'totalTransactions'));
    }

    /**
     * Ekspor laporan ke CSV (Excel)
     */
    public function exportExcel(Request $request)
    {
        $query = Booking::with(['flight.airline', 'flight.origin', 'flight.destination', 'passengers']);

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        if ($request->filled('airline_id') && $request->airline_id !== 'all') {
            $query->whereHas('flight', function ($q) use ($request) {
                $q->where('airline_id', $request->airline_id);
            });
        }
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status_pemesanan', $request->status);
        }

        $bookings = $query->orderByDesc('created_at')->get();

        $filename = 'laporan_pemesanan_' . Carbon::now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($bookings) {
            $file = fopen('php://output', 'w');

            // BOM for UTF-8
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header CSV
            fputcsv($file, [
                'No',
                'Kode Booking',
                'Nama Pemesan',
                'Email',
                'No. HP',
                'Maskapai',
                'No. Penerbangan',
                'Asal',
                'Tujuan',
                'Tanggal Keberangkatan',
                'Jumlah Penumpang',
                'Harga Tiket',
                'Total Pembayaran',
                'Status',
                'Tanggal Pemesanan',
            ]);

            foreach ($bookings as $index => $booking) {
                fputcsv($file, [
                    $index + 1,
                    $booking->kode_booking,
                    $booking->nama_pemesan,
                    $booking->email,
                    $booking->nomor_hp,
                    $booking->flight->airline->nama_maskapai ?? '-',
                    $booking->flight->nomor_penerbangan ?? '-',
                    ($booking->flight->origin->kota ?? '-') . ' (' . ($booking->flight->origin->kode_bandara ?? '') . ')',
                    ($booking->flight->destination->kota ?? '-') . ' (' . ($booking->flight->destination->kode_bandara ?? '') . ')',
                    $booking->flight->tanggal_keberangkatan ? $booking->flight->tanggal_keberangkatan->format('d/m/Y') : '-',
                    $booking->jumlah_penumpang,
                    $booking->flight->harga ?? 0,
                    $booking->total_harga,
                    $booking->status_pemesanan,
                    $booking->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Ekspor laporan ke PDF (menggunakan HTML print)
     */
    public function exportPdf(Request $request)
    {
        // Redirect ke halaman print dengan parameter
        return redirect()->route('admin.reports.print', $request->all());
    }
}
