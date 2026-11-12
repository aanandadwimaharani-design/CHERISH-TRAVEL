<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Airline;
use App\Models\Flight;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil bandara yang dikelompokkan berdasarkan tipe (domestik & internasional)
        $airports = Airport::orderBy('kota', 'asc')->get();
        $domestikAirports = $airports->where('tipe', 'domestik');
        $internasionalAirports = $airports->where('tipe', 'internasional');

        // Daftar maskapai rekanan
        $airlines = Airline::all();

        // Destinasi Domestik Rekomendasi
        $destinasiDomestik = [
            [
                'kota' => 'Bali / Denpasar',
                'kode' => 'DPS',
                'nama_bandara' => 'I Gusti Ngurah Rai (DPS)',
                'harga_mulai' => 'Rp 975.000',
                'gambar' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Favorit Liburan',
                'deskripsi' => 'Pantai eksotis, pura megah, dan kebudayaan magis Pulau Dewata.',
            ],
            [
                'kota' => 'Labuan Bajo',
                'kode' => 'LBJ',
                'nama_bandara' => 'Komodo Airport (LBJ)',
                'harga_mulai' => 'Rp 1.650.000',
                'gambar' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Petualangan Alam',
                'deskripsi' => 'Pintu gerbang Pulau Komodo, pantai pink, dan panorama laut spektakuler.',
            ],
            [
                'kota' => 'Yogyakarta',
                'kode' => 'YIA',
                'nama_bandara' => 'Yogyakarta Int. (YIA)',
                'harga_mulai' => 'Rp 750.000',
                'gambar' => 'https://images.unsplash.com/photo-1596402184320-417e7178b2cd?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Warisan Budaya',
                'deskripsi' => 'Candi Borobudur, kuliner legendaris, dan keramahtamahan istimewa.',
            ],
            [
                'kota' => 'Raja Ampat / Sorong',
                'kode' => 'SOQ',
                'nama_bandara' => 'Domine Eduard Osok (SOQ)',
                'harga_mulai' => 'Rp 2.450.000',
                'gambar' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Surga Bawah Laut',
                'deskripsi' => 'Gugusan pulau karang zamrud dan terumbu karang terbaik di dunia.',
            ],
            [
                'kota' => 'Lombok',
                'kode' => 'LOP',
                'nama_bandara' => 'Zainuddin Abdul Madjid (LOP)',
                'harga_mulai' => 'Rp 880.000',
                'gambar' => 'https://images.unsplash.com/photo-1570789210967-2cac24afeb00?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Pulau Eksotis',
                'deskripsi' => 'Pesona Gili Trawangan, Gunung Rinjani, dan sirkuit Mandalika.',
            ],
            [
                'kota' => 'Surabaya',
                'kode' => 'SUB',
                'nama_bandara' => 'Juanda Int. (SUB)',
                'harga_mulai' => 'Rp 840.000',
                'gambar' => 'https://images.unsplash.com/photo-1583037189850-1921ae7c6c22?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Kota Pahlawan',
                'deskripsi' => 'Pusat bisnis Jawa Timur dan gerbang utama menuju Gunung Bromo.',
            ],
        ];

        // Destinasi Internasional Rekomendasi
        $destinasiInternasional = [
            [
                'kota' => 'Singapura',
                'kode' => 'SIN',
                'nama_bandara' => 'Changi Airport (SIN)',
                'harga_mulai' => 'Rp 1.250.000',
                'gambar' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=700&q=80',
                'tag' => 'City Lights & Modern',
                'deskripsi' => 'Jewel Changi, Marina Bay Sands, dan surga belanja modern Asia Tenggara.',
            ],
            [
                'kota' => 'Tokyo',
                'kode' => 'HND',
                'nama_bandara' => 'Tokyo Haneda (HND)',
                'harga_mulai' => 'Rp 7.850.000',
                'gambar' => 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Negeri Sakura',
                'deskripsi' => 'Perpaduan megah kuil kuno, distrik Shibuya, dan pesona Gunung Fuji.',
            ],
            [
                'kota' => 'Seoul',
                'kode' => 'ICN',
                'nama_bandara' => 'Incheon Int. (ICN)',
                'harga_mulai' => 'Rp 6.950.000',
                'gambar' => 'https://images.unsplash.com/photo-1538485399081-7191377e8241?auto=format&fit=crop&w=700&q=80',
                'tag' => 'K-Wave & Tradisi',
                'deskripsi' => 'Istana Gyeongbokgung, kuliner Myeongdong, dan tren pop global.',
            ],
            [
                'kota' => 'London',
                'kode' => 'LHR',
                'nama_bandara' => 'Heathrow Airport (LHR)',
                'harga_mulai' => 'Rp 13.800.000',
                'gambar' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Kemegahan Eropa',
                'deskripsi' => 'Ikon Big Ben, Tower Bridge, museum kelas dunia, dan pesona kerajaan.',
            ],
            [
                'kota' => 'Mekkah & Madinah',
                'kode' => 'JED',
                'nama_bandara' => 'King Abdulaziz (JED)',
                'harga_mulai' => 'Rp 11.400.000',
                'gambar' => 'https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Wisata Religi',
                'deskripsi' => 'Perjalanan ibadah Umrah dan Haji yang khusyuk dan penuh berkah.',
            ],
            [
                'kota' => 'Paris',
                'kode' => 'CDG',
                'nama_bandara' => 'Charles de Gaulle (CDG)',
                'harga_mulai' => 'Rp 14.500.000',
                'gambar' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=700&q=80',
                'tag' => 'Kota Romantis',
                'deskripsi' => 'Pesona Menara Eiffel, Museum Louvre, dan kemewahan kafe jalanan Paris.',
            ],
        ];

        // Promo & Penawaran Tiket Pesawat
        $promos = [
            [
                'judul' => 'DISKON AKHIR TAHUN 25%',
                'kode' => 'CHERISHFLY25',
                'diskon' => 'Hemat hingga Rp 500.000',
                'deskripsi' => 'Gunakan kode promo untuk seluruh penerbangan domestik ke Bali & Jogja.',
                'periode' => 'Berlaku s.d. 31 Desember',
                'bg_gradient' => 'from-[#4A2328] to-[#6E353C]',
            ],
            [
                'judul' => 'PROMO JELAJAH ASIA',
                'kode' => 'ASIAWANDER',
                'diskon' => 'Potongan Langsung Rp 750.000',
                'deskripsi' => 'Tiket ke Singapura, Tokyo, & Seoul dengan maskapai pilihan bintang 5.',
                'periode' => 'Berlaku s.d. 15 Januari',
                'bg_gradient' => 'from-[#3B1D20] to-[#55272C]',
            ],
            [
                'judul' => 'CASHBACK EKSTRA KELUARGA',
                'kode' => 'FAMILYTRIP',
                'diskon' => 'Cashback 15% s.d. Rp 1.000.000',
                'deskripsi' => 'Pemesanan minimal 3 penumpang untuk seluruh rute domestik & luar negeri.',
                'periode' => 'Berlaku Setiap Akhir Pekan',
                'bg_gradient' => 'from-[#5C2B31] to-[#7F3E46]',
            ],
        ];

        return view('home', compact(
            'airports',
            'domestikAirports',
            'internasionalAirports',
            'airlines',
            'destinasiDomestik',
            'destinasiInternasional',
            'promos'
        ));
    }
}
