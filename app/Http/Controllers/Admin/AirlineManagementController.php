<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineManagementController extends Controller
{
    /**
     * Menampilkan daftar maskapai
     */
    public function index(Request $request)
    {
        $query = Airline::withCount('flights');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_maskapai', 'like', "%{$search}%")
                  ->orWhere('kode_maskapai', 'like', "%{$search}%");
            });
        }

        $airlines = $query->orderBy('nama_maskapai')->paginate(15)->withQueryString();

        return view('admin.airlines.index', compact('airlines'));
    }

    /**
     * Form tambah maskapai
     */
    public function create()
    {
        return view('admin.airlines.create');
    }

    /**
     * Simpan maskapai baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_maskapai' => 'required|string|max:100',
            'kode_maskapai' => 'required|string|max:10|unique:airlines,kode_maskapai',
            'logo' => 'nullable|string|max:255',
        ], [
            'kode_maskapai.unique' => 'Kode maskapai sudah digunakan.',
        ]);

        Airline::create($validated);

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil ditambahkan.');
    }

    /**
     * Form edit maskapai
     */
    public function edit($id)
    {
        $airline = Airline::findOrFail($id);

        return view('admin.airlines.edit', compact('airline'));
    }

    /**
     * Update data maskapai
     */
    public function update(Request $request, $id)
    {
        $airline = Airline::findOrFail($id);

        $validated = $request->validate([
            'nama_maskapai' => 'required|string|max:100',
            'kode_maskapai' => 'required|string|max:10|unique:airlines,kode_maskapai,' . $airline->id,
            'logo' => 'nullable|string|max:255',
        ]);

        $airline->update($validated);

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Data maskapai berhasil diperbarui.');
    }

    /**
     * Hapus maskapai
     */
    public function destroy($id)
    {
        $airline = Airline::findOrFail($id);

        if ($airline->flights()->exists()) {
            return back()->with('error', 'Maskapai ini tidak dapat dihapus karena masih memiliki penerbangan terkait.');
        }

        $airline->delete();

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil dihapus.');
    }
}
