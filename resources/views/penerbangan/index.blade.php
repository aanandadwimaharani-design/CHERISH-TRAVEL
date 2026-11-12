@extends('layouts.app')

@section('title', 'Hasil Pencarian Penerbangan - CHERISH TRAVEL')

@section('content')
<!-- SUB-HEADER / RINGKASAN PENCARIAN -->
<div class="bg-gradient-to-r from-mahogany-900 via-mahogany-800 to-mahogany-900 text-white py-8 border-b border-gold-500/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4"
             x-data="{ editSearch: false }">
            <div>
                <div class="flex items-center gap-3">
                    <span class="font-serif text-2xl sm:text-3xl font-bold tracking-tight">
                        {{ $originAirport ? $originAirport->kota : 'Semua Asal' }}
                    </span>
                    <svg class="w-6 h-6 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                    <span class="font-serif text-2xl sm:text-3xl font-bold tracking-tight">
                        {{ $destinationAirport ? $destinationAirport->kota : 'Semua Tujuan' }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-4 text-xs text-beige-200 mt-2">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $departureDate ? \Carbon\Carbon::parse($departureDate)->translatedFormat('l, d F Y') : 'Semua Tanggal' }}
                    </span>
                    @if($tripType === 'round_trip' && $returnDate)
                        <span>s/d</span>
                        <span class="flex items-center gap-1.5 text-gold-300 font-semibold">
                            <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Pulang: {{ \Carbon\Carbon::parse($returnDate)->translatedFormat('l, d F Y') }}
                        </span>
                    @endif
                    <span>•</span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        {{ $passengers }} Penumpang
                    </span>
                    <span>•</span>
                    <span class="bg-gold-500/20 text-gold-300 px-2.5 py-0.5 rounded-full border border-gold-500/30 font-medium">
                        {{ $flightClass ?: 'Semua Kelas' }}
                    </span>
                    <span>•</span>
                    <span class="bg-white/10 text-beige-200 px-2.5 py-0.5 rounded-full border border-white/20 font-medium">
                        {{ $tripType === 'round_trip' ? 'Pulang-Pergi' : 'Sekali Jalan' }}
                    </span>
                </div>
            </div>

            <!-- Tombol Ubah Pencarian -->
            <button @click="editSearch = !editSearch" class="px-5 py-2.5 rounded-xl border border-beige-300/40 text-xs font-bold uppercase tracking-wider text-beige-100 hover:bg-white/10 transition-colors flex items-center gap-2 self-start md:self-auto">
                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                <span x-text="editSearch ? 'Tutup Formulir' : 'Ubah Pencarian'"></span>
            </button>

            <!-- FORM QUICK EDIT (EXPANDABLE) -->
            <div x-cloak x-show="editSearch" x-transition class="w-full mt-6 pt-6 border-t border-white/10 bg-mahogany-950/80 p-6 rounded-2xl"
                 x-data="{
                    editTripType: '{{ $tripType }}',
                    editDepDate: '{{ $departureDate }}',
                    editRetDate: '{{ $returnDate ?: date('Y-m-d', strtotime('+3 days')) }}'
                 }">
                <form action="{{ route('flights.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">
                    <input type="hidden" name="trip_type" :value="editTripType">
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-beige-300 font-bold mb-1">Dari</label>
                        <select name="origin_id" class="w-full px-3 py-2 bg-mahogany-900 border border-mahogany-700 text-white rounded-lg text-xs">
                            <option value="">Semua Bandara Asal</option>
                            @foreach($allAirports as $a)
                                <option value="{{ $a->id }}" {{ $originId == $a->id ? 'selected' : '' }}>{{ $a->kota }} ({{ $a->kode_bandara }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-beige-300 font-bold mb-1">Ke</label>
                        <select name="destination_id" class="w-full px-3 py-2 bg-mahogany-900 border border-mahogany-700 text-white rounded-lg text-xs">
                            <option value="">Semua Bandara Tujuan</option>
                            @foreach($allAirports as $a)
                                <option value="{{ $a->id }}" {{ $destinationId == $a->id ? 'selected' : '' }}>{{ $a->kota }} ({{ $a->kode_bandara }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-beige-300 font-bold mb-1">Tgl Berangkat</label>
                        <input type="date" name="departure_date" x-model="editDepDate" class="w-full px-3 py-2 bg-mahogany-900 border border-mahogany-700 text-white rounded-lg text-xs">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label class="block text-[11px] uppercase tracking-wider text-beige-300 font-bold">Tgl Pulang</label>
                            <button type="button" @click="editTripType = (editTripType === 'round_trip' ? 'one_way' : 'round_trip')" class="text-[10px] text-gold-400 hover:underline">
                                <span x-text="editTripType === 'round_trip' ? 'Hapus' : '+ Pulang'"></span>
                            </button>
                        </div>
                        <input type="date" name="return_date" x-model="editRetDate" :disabled="editTripType !== 'round_trip'" class="w-full px-3 py-2 bg-mahogany-900 border border-mahogany-700 text-white rounded-lg text-xs" :class="editTripType !== 'round_trip' ? 'opacity-40 cursor-not-allowed' : ''">
                    </div>
                    <div>
                        <label class="block text-[11px] uppercase tracking-wider text-beige-300 font-bold mb-1">Penumpang</label>
                        <select name="passengers" class="w-full px-3 py-2 bg-mahogany-900 border border-mahogany-700 text-white rounded-lg text-xs">
                            @for($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ $passengers == $i ? 'selected' : '' }}>{{ $i }} Penumpang</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full py-2 px-4 bg-gold-500 hover:bg-gold-600 text-mahogany-950 font-bold rounded-lg text-xs uppercase tracking-wider transition-all">
                            Cari Ulang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- KONTEN UTAMA: SIDEBAR FILTER & DAFTAR PENERBANGAN -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- SIDEBAR FILTER -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-beige-300 p-6 shadow-sm sticky top-28 space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-beige-200">
                    <h3 class="font-serif text-lg font-bold text-mahogany-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-mahogany-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter Penerbangan
                    </h3>
                    <a href="{{ route('flights.index', ['origin_id' => $originId, 'destination_id' => $destinationId, 'departure_date' => $departureDate, 'passengers' => $passengers]) }}" class="text-xs text-mahogany-600 hover:text-mahogany-900 font-semibold">
                        Reset
                    </a>
                </div>

                <form id="filterForm" action="{{ route('flights.index') }}" method="GET" class="space-y-6">
                    <!-- Pertahankan Query Utama -->
                    <input type="hidden" name="origin_id" value="{{ $originId }}">
                    <input type="hidden" name="destination_id" value="{{ $destinationId }}">
                    <input type="hidden" name="departure_date" value="{{ $departureDate }}">
                    <input type="hidden" name="return_date" value="{{ $returnDate }}">
                    <input type="hidden" name="trip_type" value="{{ $tripType }}">
                    <input type="hidden" name="passengers" value="{{ $passengers }}">

                    <!-- 1. FILTER MASKAPAI -->
                    <div>
                        <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Maskapai Penerbangan</label>
                        <select name="airline_id" onchange="document.getElementById('filterForm').submit()" class="w-full px-3 py-2 bg-beige-50 border border-beige-300 rounded-xl text-xs font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700">
                            <option value="">Semua Maskapai</option>
                            @foreach($allAirlines as $air)
                                <option value="{{ $air->id }}" {{ $selectedAirline == $air->id ? 'selected' : '' }}>
                                    {{ $air->nama_maskapai }} ({{ $air->kode_maskapai }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- 2. FILTER WAKTU KEBERANGKATAN -->
                    <div>
                        <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Waktu Keberangkatan</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-xs text-mahogany-800 cursor-pointer p-2 rounded-lg hover:bg-beige-100 transition-colors {{ $timeFilter === 'pagi' ? 'bg-beige-100 font-bold' : '' }}">
                                <input type="radio" name="time_filter" value="pagi" {{ $timeFilter === 'pagi' ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()" class="text-mahogany-700 focus:ring-mahogany-700">
                                <span>Pagi (00:00 - 11:59)</span>
                            </label>
                            <label class="flex items-center gap-2 text-xs text-mahogany-800 cursor-pointer p-2 rounded-lg hover:bg-beige-100 transition-colors {{ $timeFilter === 'siang' ? 'bg-beige-100 font-bold' : '' }}">
                                <input type="radio" name="time_filter" value="siang" {{ $timeFilter === 'siang' ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()" class="text-mahogany-700 focus:ring-mahogany-700">
                                <span>Siang (12:00 - 14:59)</span>
                            </label>
                            <label class="flex items-center gap-2 text-xs text-mahogany-800 cursor-pointer p-2 rounded-lg hover:bg-beige-100 transition-colors {{ $timeFilter === 'sore' ? 'bg-beige-100 font-bold' : '' }}">
                                <input type="radio" name="time_filter" value="sore" {{ $timeFilter === 'sore' ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()" class="text-mahogany-700 focus:ring-mahogany-700">
                                <span>Sore (15:00 - 18:29)</span>
                            </label>
                            <label class="flex items-center gap-2 text-xs text-mahogany-800 cursor-pointer p-2 rounded-lg hover:bg-beige-100 transition-colors {{ $timeFilter === 'malam' ? 'bg-beige-100 font-bold' : '' }}">
                                <input type="radio" name="time_filter" value="malam" {{ $timeFilter === 'malam' ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()" class="text-mahogany-700 focus:ring-mahogany-700">
                                <span>Malam (18:30 - 23:59)</span>
                            </label>
                        </div>
                    </div>

                    <!-- 3. FILTER PENERBANGAN LANGSUNG ATAU TRANSIT -->
                    <div>
                        <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Tipe Penerbangan</label>
                        <select name="flight_type" onchange="document.getElementById('filterForm').submit()" class="w-full px-3 py-2 bg-beige-50 border border-beige-300 rounded-xl text-xs font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700">
                            <option value="Semua">Semua Tipe</option>
                            <option value="Langsung" {{ $flightType === 'Langsung' ? 'selected' : '' }}>Penerbangan Langsung</option>
                            <option value="Transit" {{ $flightType === 'Transit' ? 'selected' : '' }}>Transit</option>
                        </select>
                    </div>

                    <!-- 4. FILTER RENTANG HARGA MAKSIMAL -->
                    <div>
                        <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Harga Maksimal (Rp)</label>
                        <input type="number" name="max_price" value="{{ $maxPrice }}" placeholder="Contoh: 3000000" class="w-full px-3 py-2 bg-beige-50 border border-beige-300 rounded-xl text-xs font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700">
                    </div>

                    <!-- 5. URUTKAN (SORTING) -->
                    <div>
                        <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Urutkan Berdasarkan</label>
                        <select name="sort_by" onchange="document.getElementById('filterForm').submit()" class="w-full px-3 py-2 bg-beige-50 border border-beige-300 rounded-xl text-xs font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700">
                            <option value="price_asc" {{ $sortBy === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_desc" {{ $sortBy === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="time_asc" {{ $sortBy === 'time_asc' ? 'selected' : '' }}>Waktu Berangkat Paling Awal</option>
                            <option value="time_desc" {{ $sortBy === 'time_desc' ? 'selected' : '' }}>Waktu Berangkat Paling Akhir</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-mahogany-700 hover:bg-mahogany-800 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-colors shadow">
                        Terapkan Filter
                    </button>
                </form>
            </div>
        </div>

        <!-- DAFTAR PENERBANGAN TERSEDIA -->
        <div class="lg:col-span-3 space-y-4">
            
            <div class="flex items-center justify-between pb-2">
                <span class="text-sm font-semibold text-mahogany-800">
                    Menampilkan <strong class="text-mahogany-900">{{ $flights->count() }}</strong> pilihan penerbangan
                </span>
                <span class="text-xs text-mahogany-600">
                    Harga sudah termasuk pajak & bagasi kabin
                </span>
            </div>

            @if($flights->isEmpty())
                <!-- TAMPILAN JIKA TIDAK ADA PENERBANGAN SESUAI FILTER -->
                <div class="bg-white rounded-2xl border border-beige-300 p-12 text-center shadow-sm">
                    <div class="w-20 h-20 rounded-full bg-beige-100 border border-beige-300 flex items-center justify-center text-mahogany-600 mx-auto mb-4">
                        <svg class="w-10 h-10 transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-mahogany-900">Penerbangan Tidak Ditemukan</h3>
                    <p class="text-sm text-mahogany-700/80 max-w-md mx-auto mt-2 mb-6">
                        Maaf, tidak ada jadwal penerbangan yang sesuai dengan filter atau tanggal yang Anda tentukan. Silakan ubah tanggal atau pilihan maskapai.
                    </p>
                    <a href="{{ route('flights.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-mahogany-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider hover:bg-mahogany-800 transition-colors shadow">
                        <span>Lihat Semua Jadwal Penerbangan</span>
                    </a>
                </div>

                @if($alternativeFlights->isNotEmpty())
                    <div class="mt-8">
                        <h4 class="font-serif text-lg font-bold text-mahogany-900 mb-4 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                            Rekomendasi Penerbangan di Tanggal Terdekat:
                        </h4>
                        <div class="space-y-4">
                            @foreach($alternativeFlights as $alt)
                                @include('penerbangan.partials.flight_card', ['flight' => $alt, 'passengers' => $passengers])
                            @endforeach
                        </div>
                    </div>
                @endif

            @else
                <!-- DAFTAR KARTU PENERBANGAN -->
                @foreach($flights as $flight)
                    @include('penerbangan.partials.flight_card', ['flight' => $flight, 'passengers' => $passengers])
                @endforeach
            @endif

        </div>

    </div>
</div>
@endsection
