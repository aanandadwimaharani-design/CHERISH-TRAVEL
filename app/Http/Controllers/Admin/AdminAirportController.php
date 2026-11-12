<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AdminAirportController extends Controller
{
    public function index(Request $request)
    {
        $query = Airport::orderBy('kota', 'asc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('kode_bandara', 'like', "%{$search}%")
                  ->orWhere('nama_bandara', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%");
        }

        $airports = $query->paginate(15)->appends($request->query());

        return view('admin.airports.index', compact('airports'));
    }

    public function create()
    {
        return view('admin.airports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bandara' => 'required|string|max:10|unique:airports',
            'nama_bandara' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'negara' => 'required|string|max:100',
            'tipe' => 'required|in:domestik,internasional',
        ]);

        Airport::create($validated);

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil ditambahkan.');
    }

    public function edit(Airport $airport)
    {
        return view('admin.airports.edit', compact('airport'));
    }

    public function update(Request $request, Airport $airport)
    {
        $validated = $request->validate([
            'kode_bandara' => 'required|string|max:10|unique:airports,kode_bandara,'.$airport->id,
            'nama_bandara' => 'required|string|max:255',
            'kota' => 'required|string|max:100',
            'negara' => 'required|string|max:100',
            'tipe' => 'required|in:domestik,internasional',
        ]);

        $airport->update($validated);

        return redirect()->route('admin.airports.index')
            ->with('success', 'Data bandara berhasil diperbarui.');
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();

        return redirect()->route('admin.airports.index')
            ->with('success', 'Bandara berhasil dihapus.');
    }
}
