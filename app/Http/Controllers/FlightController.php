<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Airport;
use App\Models\Airline;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $originId = $request->query('origin_id');
        $destinationId = $request->query('destination_id');
        $departureDate = $request->query('departure_date');
        $returnDate = $request->query('return_date');
        $tripType = $request->query('trip_type', 'one_way');
        $flightClass = $request->query('flight_class');
        $passengers = max(1, (int) $request->query('passengers', 1));

        // Filter tambahan
        $selectedAirline = $request->query('airline_id');
        $maxPrice = $request->query('max_price');
        $timeFilter = $request->query('time_filter');
        $flightType = $request->query('flight_type');
        $sortBy = $request->query('sort_by', 'price_asc');

        // Query dasar
        $query = Flight::with(['airline', 'origin', 'destination'])
            ->where('status', '!=', 'Dibatalkan');

        // Filter asal jika ada
        if (!empty($originId)) {
            $query->where('airport_origin_id', $originId);
        }

        // Filter tujuan jika ada
        if (!empty($destinationId)) {
            $query->where('airport_destination_id', $destinationId);
        }

        // Filter tanggal jika ada
        if (!empty($departureDate)) {
            $query->whereDate('tanggal_keberangkatan', $departureDate);
        }

        // Filter kelas jika ada
        if (!empty($flightClass) && $flightClass !== 'Semua') {
            $query->where('kelas_penerbangan', $flightClass);
        }

        // Filter maskapai jika ada
        if (!empty($selectedAirline)) {
            $query->where('airline_id', $selectedAirline);
        }

        // Filter tipe penerbangan (Langsung / Transit)
        if (!empty($flightType) && $flightType !== 'Semua') {
            $query->where('tipe_penerbangan', $flightType);
        }

        // Filter harga maksimal
        if (!empty($maxPrice) && is_numeric($maxPrice)) {
            $query->where('harga', '<=', (float) $maxPrice);
        }

        // Filter waktu keberangkatan
        if (!empty($timeFilter)) {
            switch ($timeFilter) {
                case 'pagi': // 00:00 - 11:59
                    $query->whereTime('jam_keberangkatan', '>=', '00:00:00')
                          ->whereTime('jam_keberangkatan', '<', '12:00:00');
                    break;
                case 'siang': // 12:00 - 14:59
                    $query->whereTime('jam_keberangkatan', '>=', '12:00:00')
                          ->whereTime('jam_keberangkatan', '<', '15:00:00');
                    break;
                case 'sore': // 15:00 - 18:29
                    $query->whereTime('jam_keberangkatan', '>=', '15:00:00')
                          ->whereTime('jam_keberangkatan', '<', '18:30:00');
                    break;
                case 'malam': // 18:30 - 23:59
                    $query->whereTime('jam_keberangkatan', '>=', '18:30:00')
                          ->whereTime('jam_keberangkatan', '<=', '23:59:59');
                    break;
            }
        }

        // Sorting
        switch ($sortBy) {
            case 'price_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'time_asc':
                $query->orderBy('jam_keberangkatan', 'asc');
                break;
            case 'time_desc':
                $query->orderBy('jam_keberangkatan', 'desc');
                break;
            case 'duration_asc':
                $query->orderBy('durasi', 'asc');
                break;
            case 'price_asc':
            default:
                $query->orderBy('harga', 'asc');
                break;
        }

        $flights = $query->get();

        // Jika tidak ada penerbangan sama sekali untuk tanggal yang dicari, sediakan alternatif terdekat
        $alternativeFlights = collect();
        if ($flights->isEmpty() && (!empty($originId) || !empty($destinationId))) {
            $altQuery = Flight::with(['airline', 'origin', 'destination'])
                ->where('status', '!=', 'Dibatalkan');

            if (!empty($originId)) {
                $altQuery->where('airport_origin_id', $originId);
            }
            if (!empty($destinationId)) {
                $altQuery->where('airport_destination_id', $destinationId);
            }

            $alternativeFlights = $altQuery->orderBy('tanggal_keberangkatan', 'asc')
                ->limit(6)
                ->get();
        }

        // Data pendukung untuk filter & form
        $allAirports = Airport::orderBy('kota', 'asc')->get();
        $allAirlines = Airline::orderBy('nama_maskapai', 'asc')->get();
        $originAirport = $originId ? Airport::find($originId) : null;
        $destinationAirport = $destinationId ? Airport::find($destinationId) : null;

        return view('penerbangan.index', compact(
            'flights',
            'alternativeFlights',
            'allAirports',
            'allAirlines',
            'originAirport',
            'destinationAirport',
            'originId',
            'destinationId',
            'departureDate',
            'returnDate',
            'tripType',
            'flightClass',
            'passengers',
            'selectedAirline',
            'maxPrice',
            'timeFilter',
            'flightType',
            'sortBy'
        ));
    }
}
