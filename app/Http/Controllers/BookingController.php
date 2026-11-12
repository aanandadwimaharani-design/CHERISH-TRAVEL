<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Tampilkan Halaman Pemesanan
     */
    public function create(Request $request, $flight_id)
    {
        $flight = Flight::with(['airline', 'origin', 'destination'])->findOrFail($flight_id);

        $passengersCount = max(1, min(9, (int) $request->query('passengers', 1)));
        $tripType = $request->query('trip_type', 'Sekali Jalan');

        // Validasi sisa kursi
        if ($flight->sisa_kursi < $passengersCount) {
            return redirect()->route('flights.index', [
                'origin_id' => $flight->airport_origin_id,
                'destination_id' => $flight->airport_destination_id,
                'departure_date' => $flight->tanggal_keberangkatan->toDateString(),
            ])->with('error', "Maaf, sisa kursi penerbangan ini ({$flight->sisa_kursi} kursi) tidak mencukupi untuk {$passengersCount} penumpang.");
        }

        // Generate daftar kursi rekomendasi yang tersedia
        $availableSeats = $this->getAvailableSeats($flight);

        return view('booking.index', compact('flight', 'passengersCount', 'tripType', 'availableSeats'));
    }

    /**
     * Simpan Pemesanan Tiket Pesawat
     */
    public function store(Request $request)
    {
        // Validasi form server-side
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'nama_pemesan' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|string|max:25',
            'jumlah_penumpang' => 'required|integer|min:1|max:9',
            'tipe_perjalanan' => 'nullable|string',
            'passengers' => 'required|array|min:1',
            'passengers.*.nama_lengkap' => 'required|string|max:255',
            'passengers.*.jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'passengers.*.tanggal_lahir' => 'required|date',
            'passengers.*.nomor_identitas' => 'required|string|max:50',
            'passengers.*.nomor_kursi' => 'nullable|string|max:10',
            'passengers.*.bagasi_tambahan' => 'nullable|string',
            'passengers.*.biaya_bagasi' => 'nullable|numeric|min:0',
        ], [
            'flight_id.required' => 'Penerbangan harus dipilih.',
            'flight_id.exists' => 'Penerbangan tidak ditemukan.',
            'nama_pemesan.required' => 'Nama lengkap pemesan wajib diisi.',
            'email.required' => 'Email pemesan wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'nomor_hp.required' => 'Nomor HP/WhatsApp pemesan wajib diisi.',
            'passengers.required' => 'Data penumpang wajib diisi.',
            'passengers.*.nama_lengkap.required' => 'Nama penumpang wajib diisi.',
            'passengers.*.jenis_kelamin.required' => 'Jenis kelamin penumpang wajib dipilih.',
            'passengers.*.tanggal_lahir.required' => 'Tanggal lahir penumpang wajib diisi.',
            'passengers.*.nomor_identitas.required' => 'Nomor identitas (KTP/Paspor) wajib diisi.',
        ]);

        try {
            $booking = DB::transaction(function () use ($request) {
                // Lock row penerbangan untuk mencegah race condition / overbooking
                $flight = Flight::where('id', $request->flight_id)->lockForUpdate()->firstOrFail();

                // Hitung kursi terpesan
                $bookedSeats = Booking::where('flight_id', $flight->id)
                    ->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
                    ->sum('jumlah_penumpang');

                $remainingSeats = $flight->kapasitas_kursi - $bookedSeats;

                if ($remainingSeats < $request->jumlah_penumpang) {
                    throw new \Exception("Maaf, sisa kursi penerbangan tidak mencukupi untuk {$request->jumlah_penumpang} penumpang. Tersisa hanya {$remainingSeats} kursi.");
                }

                // Hitung total harga
                $basePricePerPerson = (float) $flight->harga;
                $totalBasePrice = $basePricePerPerson * (int) $request->jumlah_penumpang;
                $totalBaggageFee = 0;

                foreach ($request->passengers as $p) {
                    $baggageFee = isset($p['biaya_bagasi']) ? (float) $p['biaya_bagasi'] : 0;
                    $totalBaggageFee += $baggageFee;
                }

                $grandTotal = $totalBasePrice + $totalBaggageFee;

                // Generate kode booking unik
                $kodeBooking = Booking::generateKodeBooking();

                // Buat Booking
                $newBooking = Booking::create([
                    'kode_booking' => $kodeBooking,
                    'flight_id' => $flight->id,
                    'nama_pemesan' => $request->nama_pemesan,
                    'email' => $request->email,
                    'nomor_hp' => $request->nomor_hp,
                    'jumlah_penumpang' => (int) $request->jumlah_penumpang,
                    'total_harga' => $grandTotal,
                    'status_pemesanan' => 'Terkonfirmasi',
                    'tipe_perjalanan' => $request->input('tipe_perjalanan', 'Sekali Jalan'),
                ]);

                // Simpan setiap penumpang
                foreach ($request->passengers as $index => $passengerData) {
                    Passenger::create([
                        'booking_id' => $newBooking->id,
                        'nama_lengkap' => $passengerData['nama_lengkap'],
                        'jenis_kelamin' => $passengerData['jenis_kelamin'],
                        'tanggal_lahir' => $passengerData['tanggal_lahir'],
                        'nomor_identitas' => $passengerData['nomor_identitas'],
                        'nomor_kursi' => $passengerData['nomor_kursi'] ?? null,
                        'bagasi_tambahan' => $passengerData['bagasi_tambahan'] ?? '0 kg (Gratis Bagasi Kabin 7kg + Bagasi 20kg)',
                        'biaya_bagasi' => $passengerData['biaya_bagasi'] ?? 0,
                    ]);
                }

                return $newBooking;
            });

            return redirect()->route('ticket.show', ['kode_booking' => $booking->kode_booking])
                ->with('success', 'Pemesanan berhasil dikonfirmasi! E-Ticket resmi Anda telah diterbitkan.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Helper untuk menghasilkan kursi yang dapat dipilih
     */
    private function getAvailableSeats(Flight $flight)
    {
        $rows = range(10, 28);
        $cols = ['A', 'B', 'C', 'D', 'E', 'F'];
        $seats = [];

        // Ambil kursi yang sudah terpakai
        $occupiedSeats = Passenger::whereHas('booking', function ($q) use ($flight) {
            $q->where('flight_id', $flight->id);
        })->whereNotNull('nomor_kursi')->pluck('nomor_kursi')->toArray();

        foreach ($rows as $row) {
            foreach ($cols as $col) {
                $seatNumber = $row . $col;
                $seats[] = [
                    'number' => $seatNumber,
                    'is_occupied' => in_array($seatNumber, $occupiedSeats),
                ];
            }
        }

        return $seats;
    }
}
