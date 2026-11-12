@extends('layouts.app')

@section('title', 'E-Ticket Resmi #' . $booking->kode_booking . ' - CHERISH TRAVEL')

@section('content')
<!-- NOTIFIKASI SUKSES & HEADER HALAMAN -->
<div class="no-print bg-gradient-to-r from-mahogany-900 via-mahogany-800 to-mahogany-900 text-white py-8 border-b border-gold-500/30">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold border border-emerald-500/30 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Pemesanan Berhasil & E-Ticket Telah Diterbitkan</span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold">Elektronik Tiket (E-Ticket)</h1>
                <p class="text-xs text-beige-300 mt-1">Harap simpan atau cetak tiket ini sebagai bukti perjalanan yang sah saat check-in di bandara.</p>
            </div>

            <!-- TOMBOL CETAK & KEMBALI DI HEADER -->
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-600 text-mahogany-950 font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak E-Ticket</span>
                </button>
                <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-xl border border-beige-300/40 text-beige-100 hover:bg-white/10 font-bold text-xs uppercase tracking-wider transition-colors">
                    Beranda
                </a>
            </div>
        </div>

        <!-- KOTAK SOROTAN KODE BOOKING (SUPER JELAS & BISA DISALIN) -->
        <div class="mt-6 p-4 sm:p-5 bg-mahogany-950/90 rounded-2xl border-2 border-gold-500/60 flex flex-wrap items-center justify-between gap-4 shadow-2xl"
             x-data="{ copied: false }">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-12 h-12 rounded-xl bg-gold-500 text-mahogany-950 flex items-center justify-center font-bold shadow-md flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs uppercase tracking-widest text-gold-400 font-extrabold">Kode Booking Resmi (PNR)</span>
                        <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-[10px] px-2 py-0.5 rounded-full font-bold">Terkonfirmasi</span>
                    </div>
                    <div class="font-mono text-2xl sm:text-3xl font-black text-white tracking-widest mt-0.5 select-all">
                        {{ $booking->kode_booking }}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" 
                        @click="navigator.clipboard.writeText('{{ $booking->kode_booking }}'); copied = true; setTimeout(() => copied = false, 2500)"
                        class="px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-400 text-mahogany-950 font-bold text-xs uppercase tracking-wider transition-all shadow flex items-center gap-2">
                    <svg x-show="!copied" class="w-4 h-4 text-mahogany-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <svg x-show="copied" x-cloak class="w-4 h-4 text-emerald-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span x-text="copied ? 'Kode Tersalin!' : 'Salin Kode Booking'"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- KONTEN UTAMA E-TICKET (AREA CETAK RESMI) -->
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 print:py-0 print:px-0">
    
    <!-- KARTU E-TICKET DENGAN TAMPILAN BOARDING PASS MEWAH -->
    <div class="bg-white rounded-3xl border border-beige-300 shadow-2xl overflow-hidden print-ticket">
        
        <!-- HEADER BOARDING PASS -->
        <div style="background: linear-gradient(135deg, #1D090C 0%, #2E1115 50%, #431C21 100%); color: #ffffff; -webkit-print-color-adjust: exact; print-color-adjust: exact;"
             class="px-8 py-6 border-b-4 border-gold-500 flex flex-wrap items-center justify-between gap-4 text-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-black/40 border border-gold-500/40 flex items-center justify-center text-gold-400">
                    <svg class="w-6 h-6 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                </div>
                <div>
                    <span class="font-serif text-2xl font-bold tracking-wider text-white">
                        CHERISH<span class="text-gold-400">TRAVEL</span>
                    </span>
                    <span class="block text-[10px] uppercase tracking-[0.25em] text-beige-300">
                        Official Flight E-Ticket & Boarding Pass
                    </span>
                </div>
            </div>

            <!-- KODE BOOKING UNIK (CARD DI HEADER) -->
            <div class="text-left sm:text-right bg-black/30 sm:bg-black/20 p-3 sm:px-4 sm:py-2.5 rounded-xl border border-gold-500/40"
                 x-data="{ copiedHeader: false }">
                <div class="flex items-center sm:justify-end gap-1.5">
                    <span class="block text-[10px] uppercase tracking-widest text-gold-400 font-extrabold">Kode Booking / PNR:</span>
                    <button type="button" 
                            @click="navigator.clipboard.writeText('{{ $booking->kode_booking }}'); copiedHeader = true; setTimeout(() => copiedHeader = false, 2000)"
                            class="no-print text-[10px] text-gold-300 hover:text-white underline font-semibold"
                            title="Salin Kode Booking">
                        <span x-text="copiedHeader ? 'Tersalin!' : '(Salin)'"></span>
                    </button>
                </div>
                <div class="font-mono text-2xl sm:text-3xl font-extrabold tracking-widest text-white mt-0.5 select-all drop-shadow">
                    {{ $booking->kode_booking }}
                </div>
                <div class="mt-1 flex items-center sm:justify-end gap-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-[10px] font-bold uppercase bg-emerald-500/30 text-emerald-300 border border-emerald-400/40">
                        Status: {{ $booking->status_pemesanan }}
                    </span>
                </div>
            </div>
        </div>

        <!-- DETAIL PENERBANGAN: RUTE, JAM, BANDARA -->
        <div class="p-8 border-b border-dashed border-beige-300 bg-beige-50/40">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                
                <!-- MASKAPAI -->
                <div class="md:col-span-3 flex items-center gap-4">
                    <div class="w-16 h-12 bg-white rounded-xl p-2 border border-beige-200 flex items-center justify-center shadow-sm">
                        @if($booking->flight->airline && $booking->flight->airline->logo)
                            <img src="{{ asset('images/airlines/' . $booking->flight->airline->logo) }}" alt="{{ $booking->flight->airline->nama_maskapai }}" class="max-h-full max-w-full object-contain">
                        @else
                            <span class="font-bold text-xs text-mahogany-700 font-mono">{{ $booking->flight->airline->kode_maskapai }}</span>
                        @endif
                    </div>
                    <div>
                        <h3 class="font-bold text-base text-mahogany-900 leading-tight">
                            {{ $booking->flight->airline->nama_maskapai }}
                        </h3>
                        <p class="text-xs font-mono font-bold text-mahogany-600 mt-0.5">
                            {{ $booking->flight->nomor_penerbangan }}
                        </p>
                        <span class="inline-block text-[10px] font-bold text-gold-600 bg-gold-400/20 px-2 py-0.5 rounded mt-1">
                            {{ $booking->flight->kelas_penerbangan }}
                        </span>
                    </div>
                </div>

                <!-- JALUR RUTE PENERBANGAN -->
                <div class="md:col-span-6 grid grid-cols-7 items-center text-center">
                    <!-- KEBERANGKATAN -->
                    <div class="col-span-3 text-left">
                        <span class="font-serif text-3xl font-extrabold text-mahogany-950 block leading-none">
                            {{ $booking->flight->formatted_jam_keberangkatan }}
                        </span>
                        <span class="text-sm font-bold text-mahogany-800 block mt-1">
                            {{ $booking->flight->origin->kode_bandara }} - {{ $booking->flight->origin->kota }}
                        </span>
                        <span class="text-xs text-mahogany-600 block">
                            {{ $booking->flight->origin->nama_bandara }}
                        </span>
                        <span class="text-xs font-medium text-mahogany-500 block mt-0.5">
                            {{ \Carbon\Carbon::parse($booking->flight->tanggal_keberangkatan)->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    <!-- DURASI & TIPE -->
                    <div class="col-span-1 flex flex-col items-center">
                        <span class="text-[10px] text-mahogany-500 mb-1 whitespace-nowrap">{{ $booking->flight->durasi }}</span>
                        <div class="w-full flex items-center justify-center relative">
                            <div class="w-12 h-0.5 bg-mahogany-700"></div>
                            <div class="absolute bg-white px-1">
                                <svg class="w-4 h-4 text-mahogany-700 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded mt-1">
                            {{ $booking->flight->tipe_penerbangan }}
                        </span>
                    </div>

                    <!-- KEDATANGAN -->
                    <div class="col-span-3 text-right">
                        <span class="font-serif text-3xl font-extrabold text-mahogany-950 block leading-none">
                            {{ $booking->flight->formatted_jam_kedatangan }}
                        </span>
                        <span class="text-sm font-bold text-mahogany-800 block mt-1">
                            {{ $booking->flight->destination->kode_bandara }} - {{ $booking->flight->destination->kota }}
                        </span>
                        <span class="text-xs text-mahogany-600 block">
                            {{ $booking->flight->destination->nama_bandara }}
                        </span>
                        <span class="text-xs font-medium text-mahogany-500 block mt-0.5">
                            {{ \Carbon\Carbon::parse($booking->flight->tanggal_kedatangan)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                <!-- INFO TERMINAL & GERBANG -->
                <div class="md:col-span-3 bg-white p-4 rounded-xl border border-beige-300 text-left md:text-right space-y-1">
                    <div>
                        <span class="text-[10px] text-mahogany-500 uppercase tracking-wider block">Terminal Keberangkatan</span>
                        <span class="font-bold text-sm text-mahogany-900 block">{{ $booking->flight->terminal ?? 'Terminal 3' }}</span>
                    </div>
                    <div class="pt-1 border-t border-beige-100">
                        <span class="text-[10px] text-mahogany-500 uppercase tracking-wider block">Waktu Boarding</span>
                        <span class="font-bold text-sm text-gold-600 block">
                            {{ \Carbon\Carbon::parse($booking->flight->jam_keberangkatan)->subMinutes(45)->format('H:i') }} WIB
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <!-- INFORMASI PENUMPANG & QR CODE -->
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- KOLOM KIRI: DAFTAR PENUMPANG (8 COLS) -->
                <div class="lg:col-span-8 space-y-4">
                    <h4 class="font-serif text-lg font-bold text-mahogany-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Daftar Penumpang Resmi ({{ $booking->passengers->count() }} Orang)
                    </h4>

                    <div class="space-y-3">
                        @foreach($booking->passengers as $idx => $passenger)
                            <div class="bg-beige-50/70 border border-beige-300 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-mahogany-700 text-white font-bold flex items-center justify-center text-sm flex-shrink-0">
                                        {{ $idx + 1 }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h5 class="font-bold text-base text-mahogany-900">{{ $passenger->nama_lengkap }}</h5>
                                            <span class="text-[10px] text-mahogany-600 bg-white px-2 py-0.5 rounded border border-beige-200">
                                                {{ $passenger->jenis_kelamin }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-mahogany-600 mt-0.5">
                                            No. Identitas: <strong class="font-mono text-mahogany-800">{{ $passenger->nomor_identitas }}</strong>
                                        </p>
                                        <p class="text-[11px] text-mahogany-500">
                                            Tgl Lahir: {{ $passenger->formatted_tanggal_lahir }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex sm:flex-col items-end justify-between sm:justify-center border-t sm:border-t-0 pt-2 sm:pt-0 border-beige-200 text-right">
                                    <div>
                                        <span class="text-[10px] text-mahogany-500 uppercase block">Nomor Kursi</span>
                                        <span class="font-mono text-xl font-extrabold text-mahogany-900 block">
                                            {{ $passenger->nomor_kursi ?: 'Auto' }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] text-mahogany-600 mt-1 block">
                                        Bagasi: {{ $passenger->bagasi_tambahan }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- INFORMASI PEMESAN & KONTAK -->
                    <div class="pt-4 mt-6 border-t border-beige-200">
                        <span class="text-[11px] font-bold text-mahogany-700 uppercase tracking-wider block mb-2">Informasi Pemesan & Tiket</span>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-xs bg-beige-50 p-4 rounded-xl border border-beige-200">
                            <div>
                                <span class="text-mahogany-500 block">Kode Booking:</span>
                                <strong class="font-mono text-base text-mahogany-900 tracking-wider font-extrabold select-all">{{ $booking->kode_booking }}</strong>
                            </div>
                            <div>
                                <span class="text-mahogany-500 block">Nama Pemesan:</span>
                                <strong class="text-mahogany-900">{{ $booking->nama_pemesan }}</strong>
                            </div>
                            <div>
                                <span class="text-mahogany-500 block">Email:</span>
                                <strong class="text-mahogany-900">{{ $booking->email }}</strong>
                            </div>
                            <div>
                                <span class="text-mahogany-500 block">Nomor HP / WA:</span>
                                <strong class="text-mahogany-900">{{ $booking->nomor_hp }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: QR CODE & RINCIAN PEMBAYARAN (4 COLS) -->
                <div class="lg:col-span-4 bg-beige-50 p-6 rounded-2xl border border-beige-300 flex flex-col justify-between text-center">
                    
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-mahogany-600 block mb-3">
                            Verifikasi Tiket Resmi
                        </span>

                        <!-- QR CODE DISPLAY -->
                        <div class="bg-white p-4 rounded-2xl border-2 border-mahogany-700/20 shadow-md inline-block mx-auto mb-3">
                            <div id="qrcodeCanvas" class="flex justify-center items-center">
                                <!-- Fallback SVG QR Code Matrix jika tanpa JS -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 150 150" class="w-36 h-36">
                                    <rect width="150" height="150" fill="white"/>
                                    <!-- Marker kiri atas -->
                                    <rect x="10" y="10" width="35" height="35" fill="#431C21"/>
                                    <rect x="15" y="15" width="25" height="25" fill="white"/>
                                    <rect x="20" y="20" width="15" height="15" fill="#431C21"/>
                                    <!-- Marker kanan atas -->
                                    <rect x="105" y="10" width="35" height="35" fill="#431C21"/>
                                    <rect x="110" y="15" width="25" height="25" fill="white"/>
                                    <rect x="115" y="20" width="15" height="15" fill="#431C21"/>
                                    <!-- Marker kiri bawah -->
                                    <rect x="10" y="105" width="35" height="35" fill="#431C21"/>
                                    <rect x="15" y="110" width="25" height="25" fill="white"/>
                                    <rect x="20" y="115" width="15" height="15" fill="#431C21"/>
                                    <!-- QR pattern data dummy estetik -->
                                    <rect x="55" y="15" width="10" height="10" fill="#431C21"/>
                                    <rect x="75" y="15" width="10" height="10" fill="#431C21"/>
                                    <rect x="55" y="35" width="10" height="10" fill="#431C21"/>
                                    <rect x="85" y="35" width="10" height="10" fill="#431C21"/>
                                    <rect x="55" y="55" width="10" height="10" fill="#431C21"/>
                                    <rect x="75" y="55" width="10" height="10" fill="#431C21"/>
                                    <rect x="95" y="55" width="10" height="10" fill="#431C21"/>
                                    <rect x="15" y="65" width="10" height="10" fill="#431C21"/>
                                    <rect x="35" y="65" width="10" height="10" fill="#431C21"/>
                                    <rect x="55" y="75" width="10" height="10" fill="#431C21"/>
                                    <rect x="85" y="75" width="10" height="10" fill="#431C21"/>
                                    <rect x="105" y="75" width="10" height="10" fill="#431C21"/>
                                    <rect x="125" y="75" width="10" height="10" fill="#431C21"/>
                                    <rect x="65" y="95" width="10" height="10" fill="#431C21"/>
                                    <rect x="85" y="95" width="10" height="10" fill="#431C21"/>
                                    <rect x="55" y="115" width="10" height="10" fill="#431C21"/>
                                    <rect x="75" y="115" width="10" height="10" fill="#431C21"/>
                                    <rect x="105" y="115" width="10" height="10" fill="#431C21"/>
                                    <rect x="125" y="125" width="10" height="10" fill="#431C21"/>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-2 text-center">
                            <span class="block text-xs font-extrabold font-mono text-mahogany-950 tracking-wider select-all">
                                KODE: {{ $booking->kode_booking }}
                            </span>
                            <span class="block text-[10px] text-mahogany-600 mt-0.5">
                                Scan QR code untuk verifikasi keaslian e-ticket
                            </span>
                        </div>
                    </div>

                    <!-- RINCIAN PEMBAYARAN -->
                    <div class="pt-6 border-t border-beige-300 mt-6 text-left">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-mahogany-500 block mb-2">Rincian Pembayaran</span>
                        <div class="space-y-1.5 text-xs text-mahogany-800">
                            <div class="flex justify-between">
                                <span>Tiket (x{{ $booking->jumlah_penumpang }})</span>
                                <span>{{ $booking->flight->formatted_harga }} / org</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Pajak & Layanan</span>
                                <span class="text-emerald-700 font-medium">Termasuk</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-beige-200">
                                <span class="font-bold text-mahogany-900">Total Harga</span>
                                <span class="font-serif text-lg font-extrabold text-mahogany-900">
                                    {{ $booking->formatted_total_harga }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-beige-200 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-bold">
                                <svg class="w-3.5 h-3.5 text-emerald-700" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                PEMBAYARAN LUNAS
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- FOOTER E-TICKET DENGAN SYARAT & KETENTUAN PENERBANGAN -->
        <div class="bg-beige-100/70 px-8 py-5 border-t border-beige-300 text-[11px] text-mahogany-700 space-y-1">
            <p><strong>Catatan Penting Perjalanan:</strong></p>
            <ul class="list-disc list-inside space-y-0.5 text-mahogany-600">
                <li>Check-in di konter bandara dibuka 2 jam sebelum keberangkatan dan ditutup 45 menit sebelum jam keberangkatan.</li>
                <li>Tunjukkan E-Ticket ini beserta kartu identitas resmi (KTP / Paspor fisik yang masih berlaku) saat memasuki terminal dan konter check-in.</li>
                <li>Bagasi kabin maksimal 7 kg per penumpang. Bagasi tercatat harus sesuai dengan kuota yang tertera pada tiket.</li>
            </ul>
        </div>

    </div>

    <!-- TOMBOL AKSI BAWAH (CETAK & KEMBALI) -->
    <div class="no-print mt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-mahogany-700/30 text-mahogany-800 hover:bg-beige-100 text-xs font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4 text-mahogany-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Beranda</span>
        </a>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <button onclick="window.print()" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-mahogany-700 to-mahogany-900 hover:from-mahogany-800 hover:to-mahogany-950 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-xl hover:shadow-2xl flex items-center justify-center gap-2">
                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span>Cetak E-Ticket Resmi</span>
            </button>
        </div>
    </div>

</div>

<!-- LIBRARY QRCODE.JS CLIENT-SIDE GENERATION -->
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qrContainer = document.getElementById('qrcodeCanvas');
        if (qrContainer && typeof QRCode !== 'undefined') {
            qrContainer.innerHTML = '';
            new QRCode(qrContainer, {
                text: "{{ route('ticket.show', ['kode_booking' => $booking->kode_booking]) }}",
                width: 140,
                height: 140,
                colorDark : "#431C21",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        }
    });
</script>
@endpush
@endsection
