<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Http\Request;

class FlightManagementController extends Controller
{
    /**
     * Menampilkan daftar penerbangan
     */
    public function index(Request $request)
    {
        $query = Flight::with(['airline', 'origin', 'destination']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_penerbangan', 'like', "%{$search}%")
                  ->orWhereHas('airline', function ($q2) use ($search) {
                      $q2->where('nama_maskapai', 'like', "%{$search}%");
                  })
                  ->orWhereHas('origin', function ($q2) use ($search) {
                      $q2->where('kota', 'like', "%{$search}%")
                         ->orWhere('kode_bandara', 'like', "%{$search}%");
                  })
                  ->orWhereHas('destination', function ($q2) use ($search) {
                      $q2->where('kota', 'like', "%{$search}%")
                         ->orWhere('kode_bandara', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('airline_id') && $request->airline_id !== 'all') {
            $query->where('airline_id', $request->airline_id);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('kelas') && $request->kelas !== 'all') {
            $query->where('kelas_penerbangan', $request->kelas);
        }

        $flights = $query->orderByDesc('tanggal_keberangkatan')->paginate(15)->withQueryString();
        $airlines = Airline::orderBy('nama_maskapai')->get();

        return view('admin.flights.index', compact('flights', 'airlines'));
    }

    /**
     * Form tambah penerbangan
     */
    public function create()
    {
        $airlines = Airline::orderBy('nama_maskapai')->get();
        $airports = Airport::orderBy('kota')->get();

        return view('admin.flights.create', compact('airlines', 'airports'));
    }

    /**
     * Simpan penerbangan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'airport_origin_id' => 'required|exists:airports,id|different:airport_destination_id',
            'airport_destination_id' => 'required|exists:airports,id',
            'nomor_penerbangan' => 'required|string|max:20',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required',
            'tanggal_kedatangan' => 'required|date|after_or_equal:tanggal_keberangkatan',
            'jam_kedatangan' => 'required',
            'durasi' => 'required|string|max:20',
            'tipe_penerbangan' => 'required|in:Langsung,Transit',
            'kelas_penerbangan' => 'required|in:Ekonomi,Bisnis,First Class',
            'harga' => 'required|numeric|min:0',
            'kapasitas_kursi' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Penuh,Dibatalkan',
            'terminal' => 'nullable|string|max:10',
        ], [
            'airport_origin_id.different' => 'Bandara asal dan tujuan tidak boleh sama.',
            'tanggal_kedatangan.after_or_equal' => 'Tanggal kedatangan harus setelah atau sama dengan tanggal keberangkatan.',
        ]);

        Flight::create($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil ditambahkan.');
    }

    /**
     * Form edit penerbangan
     */
    public function edit($id)
    {
        $flight = Flight::findOrFail($id);
        $airlines = Airline::orderBy('nama_maskapai')->get();
        $airports = Airport::orderBy('kota')->get();

        return view('admin.flights.edit', compact('flight', 'airlines', 'airports'));
    }

    /**
     * Update data penerbangan
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'airport_origin_id' => 'required|exists:airports,id|different:airport_destination_id',
            'airport_destination_id' => 'required|exists:airports,id',
            'nomor_penerbangan' => 'required|string|max:20',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required',
            'tanggal_kedatangan' => 'required|date|after_or_equal:tanggal_keberangkatan',
            'jam_kedatangan' => 'required',
            'durasi' => 'required|string|max:20',
            'tipe_penerbangan' => 'required|in:Langsung,Transit',
            'kelas_penerbangan' => 'required|in:Ekonomi,Bisnis,First Class',
            'harga' => 'required|numeric|min:0',
            'kapasitas_kursi' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Penuh,Dibatalkan',
            'terminal' => 'nullable|string|max:10',
        ], [
            'airport_origin_id.different' => 'Bandara asal dan tujuan tidak boleh sama.',
        ]);

        $flight = Flight::findOrFail($id);
        $flight->update($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Data penerbangan berhasil diperbarui.');
    }

    /**
     * Hapus penerbangan
     */
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);

        // Cek apakah ada booking terkait
        if ($flight->bookings()->exists()) {
            return back()->with('error', 'Penerbangan ini tidak dapat dihapus karena sudah memiliki pemesanan.');
        }

        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil dihapus.');
    }
}
