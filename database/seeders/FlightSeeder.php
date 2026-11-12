<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Airport;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil bandara
        $cgk = Airport::where('kode_bandara', 'CGK')->first();
        $dps = Airport::where('kode_bandara', 'DPS')->first();
        $sub = Airport::where('kode_bandara', 'SUB')->first();
        $yia = Airport::where('kode_bandara', 'YIA')->first();
        $kno = Airport::where('kode_bandara', 'KNO')->first();
        $upg = Airport::where('kode_bandara', 'UPG')->first();
        $lbj = Airport::where('kode_bandara', 'LBJ')->first();
        $lop = Airport::where('kode_bandara', 'LOP')->first();
        $sin = Airport::where('kode_bandara', 'SIN')->first();
        $kul = Airport::where('kode_bandara', 'KUL')->first();
        $hnd = Airport::where('kode_bandara', 'HND')->first();
        $icn = Airport::where('kode_bandara', 'ICN')->first();
        $jed = Airport::where('kode_bandara', 'JED')->first();
        $lhr = Airport::where('kode_bandara', 'LHR')->first();

        // Ambil maskapai
        $garuda = Airline::where('kode_maskapai', 'GA')->first();
        $batik = Airline::where('kode_maskapai', 'ID')->first();
        $citilink = Airline::where('kode_maskapai', 'QG')->first();
        $lion = Airline::where('kode_maskapai', 'JT')->first();
        $superairjet = Airline::where('kode_maskapai', 'IU')->first();
        $airasia = Airline::where('kode_maskapai', 'QZ')->first();
        $pelita = Airline::where('kode_maskapai', 'IP')->first();
        $singapore = Airline::where('kode_maskapai', 'SQ')->first();
        $emirates = Airline::where('kode_maskapai', 'EK')->first();
        $ana = Airline::where('kode_maskapai', 'NH')->first();
        $saudia = Airline::where('kode_maskapai', 'SV')->first();

        // Template rute
        $routeTemplates = [
            // CGK -> DPS (Jakarta ke Bali)
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $dps,
                'no' => 'GA-402', 'depart' => '07:30', 'arrive' => '10:20', 'dur' => '1 Jam 50 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1485000, 'kursi' => 180, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $dps,
                'no' => 'GA-408', 'depart' => '11:15', 'arrive' => '14:05', 'dur' => '1 Jam 50 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Bisnis', 'harga' => 3250000, 'kursi' => 36, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $batik, 'origin' => $cgk, 'dest' => $dps,
                'no' => 'ID-6502', 'depart' => '08:45', 'arrive' => '11:35', 'dur' => '1 Jam 50 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1250000, 'kursi' => 160, 'terminal' => 'Terminal 2E'
            ],
            [
                'airline' => $citilink, 'origin' => $cgk, 'dest' => $dps,
                'no' => 'QG-684', 'depart' => '13:00', 'arrive' => '15:55', 'dur' => '1 Jam 55 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1050000, 'kursi' => 174, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $superairjet, 'origin' => $cgk, 'dest' => $dps,
                'no' => 'IU-752', 'depart' => '16:20', 'arrive' => '19:15', 'dur' => '1 Jam 55 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 975000, 'kursi' => 180, 'terminal' => 'Terminal 1A'
            ],
            [
                'airline' => $pelita, 'origin' => $cgk, 'dest' => $dps,
                'no' => 'IP-102', 'depart' => '19:10', 'arrive' => '22:00', 'dur' => '1 Jam 50 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1180000, 'kursi' => 180, 'terminal' => 'Terminal 3'
            ],

            // DPS -> CGK (Bali ke Jakarta)
            [
                'airline' => $garuda, 'origin' => $dps, 'dest' => $cgk,
                'no' => 'GA-405', 'depart' => '09:00', 'arrive' => '09:50', 'dur' => '1 Jam 50 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1485000, 'kursi' => 180, 'terminal' => 'Domestik'
            ],
            [
                'airline' => $batik, 'origin' => $dps, 'dest' => $cgk,
                'no' => 'ID-6511', 'depart' => '14:20', 'arrive' => '15:10', 'dur' => '1 Jam 50 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1250000, 'kursi' => 160, 'terminal' => 'Domestik'
            ],
            [
                'airline' => $citilink, 'origin' => $dps, 'dest' => $cgk,
                'no' => 'QG-687', 'depart' => '17:40', 'arrive' => '18:35', 'dur' => '1 Jam 55 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1050000, 'kursi' => 174, 'terminal' => 'Domestik'
            ],

            // CGK -> SUB (Jakarta ke Surabaya)
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $sub,
                'no' => 'GA-306', 'depart' => '06:15', 'arrive' => '07:50', 'dur' => '1 Jam 35 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1220000, 'kursi' => 162, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $pelita, 'origin' => $cgk, 'dest' => $sub,
                'no' => 'IP-204', 'depart' => '10:30', 'arrive' => '12:00', 'dur' => '1 Jam 30 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 930000, 'kursi' => 180, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $lion, 'origin' => $cgk, 'dest' => $sub,
                'no' => 'JT-690', 'depart' => '15:15', 'arrive' => '16:50', 'dur' => '1 Jam 35 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 840000, 'kursi' => 215, 'terminal' => 'Terminal 2D'
            ],

            // CGK -> YIA (Jakarta ke Yogyakarta)
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $yia,
                'no' => 'GA-206', 'depart' => '08:00', 'arrive' => '09:15', 'dur' => '1 Jam 15 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1100000, 'kursi' => 162, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $batik, 'origin' => $cgk, 'dest' => $yia,
                'no' => 'ID-6362', 'depart' => '13:45', 'arrive' => '15:00', 'dur' => '1 Jam 15 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 890000, 'kursi' => 160, 'terminal' => 'Terminal 2E'
            ],

            // CGK -> LBJ (Jakarta ke Labuan Bajo)
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $lbj,
                'no' => 'GA-452', 'depart' => '09:30', 'arrive' => '12:55', 'dur' => '2 Jam 25 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 2150000, 'kursi' => 162, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $batik, 'origin' => $cgk, 'dest' => $lbj,
                'no' => 'ID-6522', 'depart' => '06:45', 'arrive' => '12:15', 'dur' => '4 Jam 30 Menit',
                'tipe' => 'Transit', 'kelas' => 'Ekonomi', 'harga' => 1750000, 'kursi' => 160, 'terminal' => 'Terminal 2E'
            ],

            // CGK -> SIN (Jakarta ke Singapura)
            [
                'airline' => $singapore, 'origin' => $cgk, 'dest' => $sin,
                'no' => 'SQ-951', 'depart' => '05:25', 'arrive' => '08:10', 'dur' => '1 Jam 45 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 2200000, 'kursi' => 253, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $singapore, 'origin' => $cgk, 'dest' => $sin,
                'no' => 'SQ-965', 'depart' => '19:00', 'arrive' => '21:45', 'dur' => '1 Jam 45 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Bisnis', 'harga' => 6450000, 'kursi' => 40, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $sin,
                'no' => 'GA-828', 'depart' => '10:00', 'arrive' => '12:55', 'dur' => '1 Jam 55 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1850000, 'kursi' => 162, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $airasia, 'origin' => $cgk, 'dest' => $sin,
                'no' => 'QZ-262', 'depart' => '14:15', 'arrive' => '17:10', 'dur' => '1 Jam 55 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 1250000, 'kursi' => 180, 'terminal' => 'Terminal 2F'
            ],

            // CGK -> HND (Jakarta ke Tokyo)
            [
                'airline' => $ana, 'origin' => $cgk, 'dest' => $hnd,
                'no' => 'NH-856', 'depart' => '06:50', 'arrive' => '16:05', 'dur' => '7 Jam 15 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 8450000, 'kursi' => 215, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $hnd,
                'no' => 'GA-874', 'depart' => '23:35', 'arrive' => '08:50', 'dur' => '7 Jam 15 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Bisnis', 'harga' => 21500000, 'kursi' => 36, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $singapore, 'origin' => $cgk, 'dest' => $hnd,
                'no' => 'SQ-953-HND', 'depart' => '09:15', 'arrive' => '21:30', 'dur' => '10 Jam 15 Menit',
                'tipe' => 'Transit', 'kelas' => 'Ekonomi', 'harga' => 7850000, 'kursi' => 220, 'terminal' => 'Terminal 3'
            ],

            // CGK -> ICN (Jakarta ke Seoul)
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $icn,
                'no' => 'GA-878', 'depart' => '23:15', 'arrive' => '08:30', 'dur' => '7 Jam 15 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 6950000, 'kursi' => 222, 'terminal' => 'Terminal 3'
            ],

            // CGK -> JED (Jakarta ke Jeddah)
            [
                'airline' => $saudia, 'origin' => $cgk, 'dest' => $jed,
                'no' => 'SV-819', 'depart' => '11:00', 'arrive' => '16:45', 'dur' => '9 Jam 45 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Ekonomi', 'harga' => 11400000, 'kursi' => 298, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $garuda, 'origin' => $cgk, 'dest' => $jed,
                'no' => 'GA-980', 'depart' => '12:30', 'arrive' => '18:15', 'dur' => '9 Jam 45 Menit',
                'tipe' => 'Langsung', 'kelas' => 'Bisnis', 'harga' => 28500000, 'kursi' => 42, 'terminal' => 'Terminal 3'
            ],

            // CGK -> LHR (Jakarta ke London via Dubai/Singapura)
            [
                'airline' => $emirates, 'origin' => $cgk, 'dest' => $lhr,
                'no' => 'EK-357', 'depart' => '17:55', 'arrive' => '06:20', 'dur' => '18 Jam 25 Menit',
                'tipe' => 'Transit', 'kelas' => 'Ekonomi', 'harga' => 13800000, 'kursi' => 310, 'terminal' => 'Terminal 3'
            ],
            [
                'airline' => $emirates, 'origin' => $cgk, 'dest' => $lhr,
                'no' => 'EK-359', 'depart' => '00:15', 'arrive' => '13:00', 'dur' => '18 Jam 45 Menit',
                'tipe' => 'Transit', 'kelas' => 'First Class', 'harga' => 49500000, 'kursi' => 14, 'terminal' => 'Terminal 3'
            ],
        ];

        // Buat data untuk hari ini dan 30 hari ke depan
        $today = Carbon::today();

        for ($day = 0; $day <= 30; $day++) {
            $flightDate = $today->copy()->addDays($day);
            $flightDateStr = $flightDate->toDateString();

            foreach ($routeTemplates as $index => $item) {
                if (!$item['airline'] || !$item['origin'] || !$item['dest']) {
                    continue;
                }

                // Untuk kedatangan, jika lewat tengah malam
                $departDateTime = Carbon::parse($flightDateStr . ' ' . $item['depart']);
                $arriveDateTime = Carbon::parse($flightDateStr . ' ' . $item['arrive']);
                if ($arriveDateTime->lessThan($departDateTime)) {
                    $arriveDateTime->addDay();
                }

                Flight::create([
                    'airline_id' => $item['airline']->id,
                    'airport_origin_id' => $item['origin']->id,
                    'airport_destination_id' => $item['dest']->id,
                    'nomor_penerbangan' => $item['no'] . ($day > 0 ? '' : ''),
                    'tanggal_keberangkatan' => $flightDateStr,
                    'jam_keberangkatan' => $item['depart'],
                    'tanggal_kedatangan' => $arriveDateTime->toDateString(),
                    'jam_kedatangan' => $item['arrive'],
                    'durasi' => $item['dur'],
                    'tipe_penerbangan' => $item['tipe'],
                    'kelas_penerbangan' => $item['kelas'],
                    'harga' => $item['harga'],
                    'kapasitas_kursi' => $item['kursi'],
                    'status' => 'Tersedia',
                    'terminal' => $item['terminal'],
                ]);
            }
        }
    }
}
