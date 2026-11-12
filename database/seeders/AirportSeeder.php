<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        $airports = [
            // DOMESTIK
            [
                'kode_bandara' => 'CGK',
                'nama_bandara' => 'Bandara Internasional Soekarno-Hatta',
                'kota' => 'Jakarta',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'DPS',
                'nama_bandara' => 'Bandara Internasional I Gusti Ngurah Rai',
                'kota' => 'Bali / Denpasar',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'SUB',
                'nama_bandara' => 'Bandara Internasional Juanda',
                'kota' => 'Surabaya',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'YIA',
                'nama_bandara' => 'Bandara Internasional Yogyakarta',
                'kota' => 'Yogyakarta',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'KNO',
                'nama_bandara' => 'Bandara Internasional Kualanamu',
                'kota' => 'Medan',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'UPG',
                'nama_bandara' => 'Bandara Internasional Sultan Hasanuddin',
                'kota' => 'Makassar',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'LBJ',
                'nama_bandara' => 'Bandara Internasional Komodo',
                'kota' => 'Labuan Bajo',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'LOP',
                'nama_bandara' => 'Bandara Internasional Zainuddin Abdul Madjid',
                'kota' => 'Lombok',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'BPN',
                'nama_bandara' => 'Bandara Internasional Sultan Aji Muhammad Sulaiman Sepinggan',
                'kota' => 'Balikpapan',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'SRG',
                'nama_bandara' => 'Bandara Internasional Jenderal Ahmad Yani',
                'kota' => 'Semarang',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'SOQ',
                'nama_bandara' => 'Bandara Domine Eduard Osok',
                'kota' => 'Sorong / Raja Ampat',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],
            [
                'kode_bandara' => 'MDC',
                'nama_bandara' => 'Bandara Internasional Sam Ratulangi',
                'kota' => 'Manado',
                'negara' => 'Indonesia',
                'tipe' => 'domestik',
            ],

            // INTERNASIONAL
            [
                'kode_bandara' => 'SIN',
                'nama_bandara' => 'Singapore Changi Airport',
                'kota' => 'Singapura',
                'negara' => 'Singapura',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'KUL',
                'nama_bandara' => 'Kuala Lumpur International Airport',
                'kota' => 'Kuala Lumpur',
                'negara' => 'Malaysia',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'HND',
                'nama_bandara' => 'Tokyo Haneda International Airport',
                'kota' => 'Tokyo',
                'negara' => 'Jepang',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'ICN',
                'nama_bandara' => 'Incheon International Airport',
                'kota' => 'Seoul',
                'negara' => 'Korea Selatan',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'BKK',
                'nama_bandara' => 'Suvarnabhumi International Airport',
                'kota' => 'Bangkok',
                'negara' => 'Thailand',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'DXB',
                'nama_bandara' => 'Dubai International Airport',
                'kota' => 'Dubai',
                'negara' => 'Uni Emirat Arab',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'JED',
                'nama_bandara' => 'King Abdulaziz International Airport',
                'kota' => 'Jeddah / Mekkah',
                'negara' => 'Arab Saudi',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'LHR',
                'nama_bandara' => 'London Heathrow Airport',
                'kota' => 'London',
                'negara' => 'Inggris',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'CDG',
                'nama_bandara' => 'Charles de Gaulle Airport',
                'kota' => 'Paris',
                'negara' => 'Prancis',
                'tipe' => 'internasional',
            ],
            [
                'kode_bandara' => 'SYD',
                'nama_bandara' => 'Sydney Kingsford Smith Airport',
                'kota' => 'Sydney',
                'negara' => 'Australia',
                'tipe' => 'internasional',
            ],
        ];

        foreach ($airports as $airport) {
            Airport::updateOrCreate(
                ['kode_bandara' => $airport['kode_bandara']],
                $airport
            );
        }
    }
}
