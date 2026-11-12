<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportManagementController extends Controller
{
    /**
     * Menampilkan daftar bandara
     */
    public function index(Request $request)
    {
        $query = Airport::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_bandara', 'like', "%{$search}%")
                  ->orWhere('kode_bandara', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('negara', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipe') && $request->tipe !== 'all') {
            $query->where('tipe', $request->tipe);
        }

        $airports = $query->orderBy('kota')->paginate(15)->withQueryString();

        return view('admin.airports.index', compact('airports'));
    }

    /**
     * Form tambah bandara
     */
    public function create()
    {
        return view('admin.airports.create');
    }

    /**
     * Simpan bandara baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bandara' => 'required|string|max:10|unique:airports,kode_bandara',
            'nama_bandara' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'negara' => 'required|string|max:100',
            'tipe' => 'required|in:domestik,internasional',
        ], [
            'kode_bandara.unique' => 'Kode bandara sudah digunakan.',
        ]);

        Airport::create($validated);

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil ditambahkan.');
    }

    /**
     * Form edit bandara
     */
    public function edit($id)
    {
        $airport = Airport::findOrFail($id);

        return view('admin.airports.edit', compact('airport'));
    }

    /**
     * Update data bandara
     */
    public function update(Request $request, $id)
    {
        $airport = Airport::findOrFail($id);

        $validated = $request->validate([
            'kode_bandara' => 'required|string|max:10|unique:airports,kode_bandara,' . $airport->id,
            'nama_bandara' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'negara' => 'required|string|max:100',
            'tipe' => 'required|in:domestik,internasional',
        ]);

        $airport->update($validated);

        return redirect()->route('admin.airports.index')
            ->with('success', 'Data bandara berhasil diperbarui.');
    }

    /**
     * Hapus bandara
     */
    public function destroy($id)
    {
        $airport = Airport::findOrFail($id);

        $hasFlights = $airport->flightsOrigin()->exists() || $airport->flightsDestination()->exists();
        if ($hasFlights) {
            return back()->with('error', 'Bandara ini tidak dapat dihapus karena masih memiliki penerbangan terkait.');
        }

        $airport->delete();

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil dihapus.');
    }
}
