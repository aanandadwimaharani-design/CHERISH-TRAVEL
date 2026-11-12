<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class AdminAirlineController extends Controller
{
    public function index(Request $request)
    {
        $query = Airline::orderBy('nama_maskapai', 'asc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_maskapai', 'like', "%{$search}%")
                  ->orWhere('kode_maskapai', 'like', "%{$search}%");
        }

        $airlines = $query->paginate(15)->appends($request->query());

        return view('admin.airlines.index', compact('airlines'));
    }

    public function create()
    {
        return view('admin.airlines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_maskapai' => 'required|string|max:100',
            'kode_maskapai' => 'required|string|max:10|unique:airlines',
            'logo' => 'nullable|string|max:255',
        ]);

        Airline::create($validated);

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil ditambahkan.');
    }

    public function edit(Airline $airline)
    {
        return view('admin.airlines.edit', compact('airline'));
    }

    public function update(Request $request, Airline $airline)
    {
        $validated = $request->validate([
            'nama_maskapai' => 'required|string|max:100',
            'kode_maskapai' => 'required|string|max:10|unique:airlines,kode_maskapai,'.$airline->id,
            'logo' => 'nullable|string|max:255',
        ]);

        $airline->update($validated);

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Data maskapai berhasil diperbarui.');
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();

        return redirect()->route('admin.airlines.index')
            ->with('success', 'Maskapai berhasil dihapus.');
    }
}
