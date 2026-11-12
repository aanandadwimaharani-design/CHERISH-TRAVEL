<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airline;

class AirlineSeeder extends Seeder
{
    public function run(): void
    {
        $airlines = [
            [
                'nama_maskapai' => 'Garuda Indonesia',
                'kode_maskapai' => 'GA',
                'logo' => 'garuda.svg',
            ],
            [
                'nama_maskapai' => 'Batik Air',
                'kode_maskapai' => 'ID',
                'logo' => 'batik.svg',
            ],
            [
                'nama_maskapai' => 'Citilink',
                'kode_maskapai' => 'QG',
                'logo' => 'citilink.svg',
            ],
            [
                'nama_maskapai' => 'Lion Air',
                'kode_maskapai' => 'JT',
                'logo' => 'lion.svg',
            ],
            [
                'nama_maskapai' => 'Super Air Jet',
                'kode_maskapai' => 'IU',
                'logo' => 'superairjet.svg',
            ],
            [
                'nama_maskapai' => 'AirAsia',
                'kode_maskapai' => 'QZ',
                'logo' => 'airasia.svg',
            ],
            [
                'nama_maskapai' => 'Pelita Air',
                'kode_maskapai' => 'IP',
                'logo' => 'pelita.svg',
            ],
            [
                'nama_maskapai' => 'Singapore Airlines',
                'kode_maskapai' => 'SQ',
                'logo' => 'singapore.svg',
            ],
            [
                'nama_maskapai' => 'Qatar Airways',
                'kode_maskapai' => 'QR',
                'logo' => 'qatar.svg',
            ],
            [
                'nama_maskapai' => 'Emirates',
                'kode_maskapai' => 'EK',
                'logo' => 'emirates.svg',
            ],
            [
                'nama_maskapai' => 'ANA All Nippon Airways',
                'kode_maskapai' => 'NH',
                'logo' => 'ana.svg',
            ],
            [
                'nama_maskapai' => 'Saudia',
                'kode_maskapai' => 'SV',
                'logo' => 'saudia.svg',
            ],
        ];

        foreach ($airlines as $airline) {
            Airline::updateOrCreate(
                ['kode_maskapai' => $airline['kode_maskapai']],
                $airline
            );
        }
    }
}
