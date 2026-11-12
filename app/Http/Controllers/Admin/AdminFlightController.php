<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Http\Request;

class AdminFlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::with(['airline', 'origin', 'destination']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_penerbangan', 'like', "%{$search}%")
                  ->orWhereHas('airline', function ($aq) use ($search) {
                      $aq->where('nama_maskapai', 'like', "%{$search}%");
                  })
                  ->orWhereHas('origin', function ($oq) use ($search) {
                      $oq->where('kota', 'like', "%{$search}%");
                  })
                  ->orWhereHas('destination', function ($dq) use ($search) {
                      $dq->where('kota', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('airline_id')) {
            $query->where('airline_id', $request->airline_id);
        }

        $flights = $query->latest('created_at')->paginate(15)->appends($request->query());

        $airlines = Airline::orderBy('nama_maskapai', 'asc')->get();
        $statuses = ['Tersedia', 'Penuh', 'Dibatalkan'];

        return view('admin.flights.index', compact('flights', 'airlines', 'statuses'));
    }

    public function create()
    {
        $airlines = Airline::orderBy('nama_maskapai', 'asc')->get();
        $airports = Airport::orderBy('kota', 'asc')->get();

        return view('admin.flights.create', compact('airlines', 'airports'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'airport_origin_id' => 'required|exists:airports,id',
            'airport_destination_id' => 'required|exists:airports,id|different:airport_origin_id',
            'nomor_penerbangan' => 'required|string|max:20|unique:flights',
            'tanggal_keberangkatan' => 'required|date|after_or_equal:today',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'tanggal_kedatangan' => 'required|date|after_or_equal:tanggal_keberangkatan',
            'jam_kedatangan' => 'required|date_format:H:i',
            'durasi' => 'required|string|max:50',
            'tipe_penerbangan' => 'required|in:Langsung,Transit',
            'kelas_penerbangan' => 'required|in:Ekonomi,Bisnis,First Class',
            'harga' => 'required|numeric|min:0',
            'kapasitas_kursi' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Penuh,Dibatalkan',
            'terminal' => 'nullable|string|max:50',
        ], [
            'airport_destination_id.different' => 'Bandara tujuan harus berbeda dari bandara keberangkatan.',
            'nomor_penerbangan.unique' => 'Nomor penerbangan sudah terdaftar.',
        ]);

        Flight::create($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil ditambahkan.');
    }

    public function edit(Flight $flight)
    {
        $airlines = Airline::orderBy('nama_maskapai', 'asc')->get();
        $airports = Airport::orderBy('kota', 'asc')->get();

        return view('admin.flights.edit', compact('flight', 'airlines', 'airports'));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'airport_origin_id' => 'required|exists:airports,id',
            'airport_destination_id' => 'required|exists:airports,id|different:airport_origin_id',
            'nomor_penerbangan' => 'required|string|max:20|unique:flights,nomor_penerbangan,'.$flight->id,
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required|date_format:H:i',
            'tanggal_kedatangan' => 'required|date|after_or_equal:tanggal_keberangkatan',
            'jam_kedatangan' => 'required|date_format:H:i',
            'durasi' => 'required|string|max:50',
            'tipe_penerbangan' => 'required|in:Langsung,Transit',
            'kelas_penerbangan' => 'required|in:Ekonomi,Bisnis,First Class',
            'harga' => 'required|numeric|min:0',
            'kapasitas_kursi' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Penuh,Dibatalkan',
            'terminal' => 'nullable|string|max:50',
        ], [
            'airport_destination_id.different' => 'Bandara tujuan harus berbeda dari bandara keberangkatan.',
            'nomor_penerbangan.unique' => 'Nomor penerbangan sudah terdaftar.',
        ]);

        $flight->update($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Data penerbangan berhasil diperbarui.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil dihapus.');
    }
}
