<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show($kode_booking)
    {
        $booking = Booking::with([
            'flight.airline',
            'flight.origin',
            'flight.destination',
            'passengers',
        ])->where('kode_booking', $kode_booking)->firstOrFail();

        // Data payload untuk QR Code
        $qrData = route('ticket.show', ['kode_booking' => $booking->kode_booking]);

        return view('tiket.show', compact('booking', 'qrData'));
    }
}
