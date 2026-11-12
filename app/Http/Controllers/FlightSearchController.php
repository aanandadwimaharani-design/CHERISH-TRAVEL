<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\Flight;

class FlightSearchController extends Controller
{
    public function index()
    {
        $bandara = Airport::orderBy('kota')->get();

        return view('welcome', compact('bandara'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'asal' => 'required|different:tujuan',
            'tujuan' => 'required',
            'tanggal' => 'required|date',
            'penumpang' => 'required|integer|min:1',
        ]);

        $penerbangan = Flight::with([
            'bandaraAsal',
            'bandaraTujuan'
        ])
        ->where('asal_id', $request->asal)
        ->where('tujuan_id', $request->tujuan)
        ->whereDate('berangkat_pada', $request->tanggal)
        ->where('kursi_tersedia', '>=', $request->penumpang)
        ->get();

        return view('penerbangan.hasil', compact('penerbangan'));
    }
}