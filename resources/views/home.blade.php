@extends('layouts.app')

@section('title', 'CHERISH TRAVEL - Pemesanan Tiket Pesawat Mewah & Terpercaya')

@section('content')
<!-- HERO SECTION & BANNER UTAMA -->
<section class="relative bg-gradient-to-b from-mahogany-950 via-mahogany-900 to-mahogany-800 text-white overflow-hidden pt-12 pb-28 md:py-24">
    <!-- Background Image Pesawat / Bandara Elegan dengan Overlay -->
    <div class="absolute inset-0 z-0 opacity-25 mix-blend-luminosity">
        <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=1920&q=80" alt="Pesawat Cherish Travel" class="w-full h-full object-cover">
    </div>
    
    <!-- Pattern Hiasan Geometris Elegan -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-gold-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-mahogany-600/20 blur-3xl pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Badge Kemewahan -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-mahogany-800/80 border border-gold-500/30 text-gold-400 text-xs font-semibold uppercase tracking-widest mb-6 backdrop-blur-sm animate-pulse">
            <svg class="w-4 h-4 text-gold-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <span>Pengalaman Terbang Premium & Berkelas</span>
        </div>

        <!-- Judul Utama -->
        <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white mb-6 leading-tight">
            Menjelajahi Dunia Bersama <br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-beige-100 via-gold-400 to-beige-200">
                CHERISH TRAVEL
            </span>
        </h1>

        <!-- Tagline / Subtitle -->
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-beige-200/90 font-light leading-relaxed mb-10">
            Temukan penerbangan domestik dan internasional terbaik dengan jaminan harga transparan, fasilitas terlengkap, dan kenyamanan tanpa kompromi.
        </p>
    </div>
</section>

<!-- FORM PENCARIAN TIKET PESAWAT (INTERAKTIF DENGAN ALPINE.JS) -->
<section class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 md:-mt-24 mb-16">
    <div class="bg-white rounded-3xl shadow-2xl border border-beige-300 p-6 sm:p-8 backdrop-blur-lg"
         x-data="{
            tripType: 'one_way',
            originId: '1',
            destinationId: '2',
            departureDate: '{{ date('Y-m-d') }}',
            returnDate: '{{ date('Y-m-d', strtotime('+3 days')) }}',
            passengers: 1,
            flightClass: 'Ekonomi',
            swapAirports() {
                let temp = this.originId;
                this.originId = this.destinationId;
                this.destinationId = temp;
            },
            activateRoundTrip() {
                this.tripType = 'round_trip';
                if (!this.returnDate || this.returnDate < this.departureDate) {
                    let d = new Date(this.departureDate);
                    d.setDate(d.getDate() + 3);
                    this.returnDate = d.toISOString().split('T')[0];
                }
                this.$nextTick(() => {
                    const inputEl = this.$refs.returnDateInput;
                    if (inputEl) {
                        if (typeof inputEl.showPicker === 'function') {
                            try { inputEl.showPicker(); } catch(e) { inputEl.focus(); }
                        } else {
                            inputEl.focus();
                        }
                    }
                });
            },
            setOneWay() {
                this.tripType = 'one_way';
            }
         }">
        
        <!-- HEADER FORM: PILIHAN PERJALANAN (SEKALI JALAN / PULANG-PERGI) -->
        <div class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-6 border-b border-beige-200">
            <!-- Tipe Perjalanan Switcher -->
            <div class="flex items-center bg-beige-100 p-1.5 rounded-2xl border border-beige-200">
                <button type="button" 
                        @click="setOneWay()" 
                        :class="tripType === 'one_way' ? 'bg-mahogany-700 text-white shadow-sm' : 'text-mahogany-800 hover:text-mahogany-900'"
                        class="px-5 py-2 rounded-xl text-xs sm:text-sm font-bold tracking-wide transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                    <span>Sekali Jalan</span>
                </button>
                <button type="button" 
                        @click="activateRoundTrip()" 
                        :class="tripType === 'round_trip' ? 'bg-mahogany-700 text-white shadow-sm' : 'text-mahogany-800 hover:text-mahogany-900'"
                        class="px-5 py-2 rounded-xl text-xs sm:text-sm font-bold tracking-wide transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <span>Pulang - Pergi</span>
                    <span x-show="tripType === 'round_trip'" class="w-2 h-2 rounded-full bg-gold-400"></span>
                </button>
            </div>

            <!-- Kelas Penerbangan & Jumlah Penumpang Info Ringkas -->
            <div class="flex items-center gap-3 text-xs text-mahogany-700 font-medium">
                <span class="flex items-center gap-1.5 bg-beige-50 px-3 py-1.5 rounded-lg border border-beige-200">
                    <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Bebas Biaya Pemesanan
                </span>
                <span class="flex items-center gap-1.5 bg-beige-50 px-3 py-1.5 rounded-lg border border-beige-200">
                    <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    E-Ticket Instan & Resmi
                </span>
            </div>
        </div>

        <!-- FORM ACTION KE /penerbangan -->
        <form action="{{ route('flights.index') }}" method="GET">
            <input type="hidden" name="trip_type" :value="tripType">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                
                <!-- ASAL (KOTA / BANDARA) -->
                <div class="md:col-span-5 relative">
                    <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-700 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                        <span>Dari (Kota / Bandara Asal)</span>
                    </label>
                    <div class="relative">
                        <select name="origin_id" x-model="originId" required class="w-full pl-4 pr-10 py-3.5 bg-beige-50/70 border border-beige-300 rounded-xl font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all text-sm appearance-none cursor-pointer">
                            <optgroup label="-- Bandara Domestik Indonesia --">
                                @foreach($domestikAirports as $apt)
                                    <option value="{{ $apt->id }}">{{ $apt->kota }} ({{ $apt->kode_bandara }}) - {{ $apt->nama_bandara }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="-- Bandara Internasional --">
                                @foreach($internasionalAirports as $apt)
                                    <option value="{{ $apt->id }}">{{ $apt->kota }} ({{ $apt->kode_bandara }}) - {{ $apt->nama_bandara }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-mahogany-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL TUKAR RUTE (SWAP) -->
                <div class="md:col-span-2 flex justify-center py-1">
                    <button type="button" 
                            @click="swapAirports()" 
                            title="Tukar Asal dan Tujuan"
                            class="w-11 h-11 rounded-full bg-beige-100 hover:bg-mahogany-700 hover:text-white text-mahogany-800 border border-beige-300 shadow-sm flex items-center justify-center transition-all duration-300 transform hover:rotate-180">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </button>
                </div>

                <!-- TUJUAN (KOTA / BANDARA) -->
                <div class="md:col-span-5 relative">
                    <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-700 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                        <span>Ke (Kota / Bandara Tujuan)</span>
                    </label>
                    <div class="relative">
                        <select name="destination_id" x-model="destinationId" required class="w-full pl-4 pr-10 py-3.5 bg-beige-50/70 border border-beige-300 rounded-xl font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all text-sm appearance-none cursor-pointer">
                            <optgroup label="-- Bandara Domestik Indonesia --">
                                @foreach($domestikAirports as $apt)
                                    <option value="{{ $apt->id }}">{{ $apt->kota }} ({{ $apt->kode_bandara }}) - {{ $apt->nama_bandara }}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="-- Bandara Internasional --">
                                @foreach($internasionalAirports as $apt)
                                    <option value="{{ $apt->id }}">{{ $apt->kota }} ({{ $apt->kode_bandara }}) - {{ $apt->nama_bandara }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-mahogany-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- BARIS KEDUA: TANGGAL, JUMLAH PENUMPANG, KELAS, TOMBOL CARI -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-5">
                
                <!-- TANGGAL KEBERANGKATAN -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-700 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Tanggal Berangkat</span>
                    </label>
                    <input type="date" 
                           name="departure_date" 
                           x-model="departureDate"
                           @change="if (returnDate < departureDate) returnDate = departureDate"
                           min="{{ date('Y-m-d') }}"
                           required 
                           class="w-full px-4 py-3 bg-beige-50/70 border border-beige-300 rounded-xl font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all text-sm cursor-pointer">
                </div>

                <!-- TANGGAL KEPULANGAN (INTERAKTIF & AUTO-AKTIF SAAT DIKLIK) -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-700 flex items-center gap-1.5"
                               :class="tripType === 'one_way' ? 'opacity-70' : ''">
                            <svg class="w-3.5 h-3.5 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>Tanggal Pulang</span>
                        </label>
                        
                        <!-- Toggle Cepat / Status Pulang-Pergi -->
                        <template x-if="tripType === 'one_way'">
                            <button type="button" 
                                    @click="activateRoundTrip()"
                                    class="text-[11px] font-semibold text-mahogany-700 hover:text-mahogany-900 underline flex items-center gap-0.5 transition-colors">
                                <span>+ Aktifkan Pulang</span>
                            </button>
                        </template>
                        <template x-if="tripType === 'round_trip'">
                            <button type="button" 
                                    @click="setOneWay()"
                                    class="text-[11px] font-semibold text-red-600 hover:text-red-700 flex items-center gap-0.5 transition-colors">
                                <span>&times; Sekali Jalan</span>
                            </button>
                        </template>
                    </div>

                    <!-- Input Box Wrapper dengan Klik Auto-Aktif -->
                    <div class="relative group">
                        <input type="date" 
                               x-ref="returnDateInput"
                               name="return_date" 
                               x-model="returnDate"
                               :min="departureDate"
                               :disabled="tripType === 'one_way'"
                               class="w-full px-4 py-3 border border-beige-300 rounded-xl font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all text-sm cursor-pointer"
                               :class="tripType === 'one_way' ? 'bg-gray-100 opacity-60' : 'bg-beige-50/70'">

                        <!-- Overlay Interaktif saat Sekali Jalan: Mengklik kotak ini langsung mengubah ke Pulang-Pergi & membuka kalender -->
                        <div x-show="tripType === 'one_way'"
                             @click="activateRoundTrip()"
                             title="Klik untuk memilih tanggal kepulangan (Pulang-Pergi)"
                             class="absolute inset-0 bg-beige-100/90 hover:bg-beige-200/90 rounded-xl border border-dashed border-beige-400 hover:border-mahogany-600 cursor-pointer flex items-center justify-between px-3.5 transition-all">
                            <span class="text-xs font-semibold text-mahogany-700 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <span>Pilih Tanggal Pulang</span>
                            </span>
                            <span class="text-[10px] font-bold text-mahogany-800 bg-white/90 border border-beige-300 px-2 py-0.5 rounded shadow-xs">
                                Pulang - Pergi
                            </span>
                        </div>
                    </div>
                </div>

                <!-- JUMLAH PENUMPANG -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-700 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Jumlah Penumpang</span>
                    </label>
                    <select name="passengers" x-model="passengers" class="w-full px-4 py-3 bg-beige-50/70 border border-beige-300 rounded-xl font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all text-sm cursor-pointer">
                        <option value="1">1 Penumpang</option>
                        <option value="2">2 Penumpang</option>
                        <option value="3">3 Penumpang</option>
                        <option value="4">4 Penumpang</option>
                        <option value="5">5 Penumpang</option>
                        <option value="6">6 Penumpang</option>
                        <option value="7">7 Penumpang</option>
                        <option value="8">8 Penumpang</option>
                        <option value="9">9 Penumpang</option>
                    </select>
                </div>

                <!-- KELAS PENERBANGAN -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-700 mb-1.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-mahogany-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <span>Kelas Penerbangan</span>
                    </label>
                    <select name="flight_class" x-model="flightClass" class="w-full px-4 py-3 bg-beige-50/70 border border-beige-300 rounded-xl font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all text-sm cursor-pointer">
                        <option value="Semua">Semua Kelas</option>
                        <option value="Ekonomi">Kelas Ekonomi</option>
                        <option value="Bisnis">Kelas Bisnis</option>
                        <option value="First Class">First Class</option>
                    </select>
                </div>

            </div>

            <!-- TOMBOL CARI PENERBANGAN -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-10 py-4 rounded-xl font-bold uppercase tracking-wider text-sm bg-gradient-to-r from-mahogany-700 via-mahogany-800 to-mahogany-900 hover:from-mahogany-800 hover:to-mahogany-950 text-white shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-3 group">
                    <svg class="w-5 h-5 text-gold-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Cari Penerbangan</span>
                    <svg class="w-4 h-4 text-white/70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

        </form>
    </div>
</section>

<!-- KEUNGGULAN CHERISH TRAVEL -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mb-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-beige-200 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-beige-100 border border-beige-300 flex items-center justify-center text-mahogany-700 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-mahogany-900 text-sm">Harga Terbaik</h4>
                <p class="text-xs text-mahogany-700/80 mt-1">Tanpa biaya tersembunyi, jaminan tarif resmi maskapai.</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-beige-200 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-beige-100 border border-beige-300 flex items-center justify-center text-mahogany-700 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-mahogany-900 text-sm">Transaksi Aman</h4>
                <p class="text-xs text-mahogany-700/80 mt-1">Enkripsi terproteksi untuk keamanan data pemesanan.</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-beige-200 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-beige-100 border border-beige-300 flex items-center justify-center text-mahogany-700 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-mahogany-900 text-sm">E-Ticket Instan</h4>
                <p class="text-xs text-mahogany-700/80 mt-1">Terbit otomatis lengkap dengan QR Code boarding resmi.</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-beige-200 shadow-sm hover:shadow-md transition-shadow flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-beige-100 border border-beige-300 flex items-center justify-center text-mahogany-700 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <h4 class="font-bold text-mahogany-900 text-sm">Bantuan 24/7</h4>
                <p class="text-xs text-mahogany-700/80 mt-1">Layanan pelanggan siap membantu perjalanan Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- PROMO DAN PENAWARAN TIKET PESAWAT -->
<section id="promo" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
        <div>
            <span class="text-xs uppercase font-bold tracking-widest text-gold-600 bg-gold-400/20 px-3 py-1 rounded-md">
                Penawaran Spesial
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-mahogany-900 mt-2">
                Promo & Diskon Tiket Pesawat
            </h2>
            <p class="text-sm text-mahogany-700/80 mt-1">
                Gunakan kode voucher eksklusif untuk mendapatkan potongan harga istimewa.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-data="{ copiedCode: null }">
        @foreach($promos as $promo)
            <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br {{ $promo['bg_gradient'] }} text-white p-7 shadow-lg flex flex-col justify-between group hover:-translate-y-1 transition-all duration-300">
                <!-- Watermark Ikon Tiket -->
                <div class="absolute -right-6 -bottom-6 opacity-10 text-white pointer-events-none group-hover:scale-110 transition-transform">
                    <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                </div>

                <div>
                    <span class="inline-block text-[11px] font-bold tracking-wider uppercase bg-white/20 px-3 py-1 rounded-full mb-4">
                        {{ $promo['periode'] }}
                    </span>
                    <h3 class="font-serif text-2xl font-bold text-white mb-1">
                        {{ $promo['judul'] }}
                    </h3>
                    <p class="text-gold-400 font-bold text-sm mb-3">
                        {{ $promo['diskon'] }}
                    </p>
                    <p class="text-xs text-beige-100/80 leading-relaxed mb-6">
                        {{ $promo['deskripsi'] }}
                    </p>
                </div>

                <!-- Kode Voucher & Tombol Salin -->
                <div class="pt-4 border-t border-white/15 flex items-center justify-between">
                    <div>
                        <span class="block text-[10px] uppercase tracking-wider text-beige-300">Kode Voucher</span>
                        <span class="font-mono text-base font-bold text-gold-300 tracking-wider">{{ $promo['kode'] }}</span>
                    </div>
                    <button type="button" 
                            @click="navigator.clipboard.writeText('{{ $promo['kode'] }}'); copiedCode = '{{ $promo['kode'] }}'; setTimeout(() => copiedCode = null, 2500)"
                            class="px-3.5 py-1.5 bg-white text-mahogany-900 hover:bg-beige-100 rounded-lg text-xs font-bold transition-colors flex items-center gap-1.5 shadow">
                        <span x-text="copiedCode === '{{ $promo['kode'] }}' ? 'Tersalin!' : 'Salin'"></span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- REKOMENDASI DESTINASI DOMESTIK -->
<section id="rekomendasi" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
        <div>
            <span class="text-xs uppercase font-bold tracking-widest text-mahogany-700 bg-beige-200 px-3 py-1 rounded-md">
                Jelajahi Indonesia
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-mahogany-900 mt-2">
                Rekomendasi Destinasi Domestik
            </h2>
            <p class="text-sm text-mahogany-700/80 mt-1">
                Keindahan pesona alam dan kekayaan budaya Nusantara siap menyambut Anda.
            </p>
        </div>
        <a href="{{ route('flights.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-bold text-mahogany-700 hover:text-mahogany-900 group">
            <span>Lihat Semua Penerbangan</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($destinasiDomestik as $dest)
            <div class="bg-white rounded-2xl overflow-hidden border border-beige-200 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col">
                <!-- Foto Destinasi -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $dest['gambar'] }}" alt="{{ $dest['kota'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-mahogany-950/80 via-transparent to-transparent"></div>
                    
                    <span class="absolute top-4 left-4 bg-mahogany-800/90 text-gold-400 text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm border border-gold-500/20">
                        {{ $dest['tag'] }}
                    </span>

                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-serif text-2xl font-bold">{{ $dest['kota'] }}</h3>
                        <p class="text-xs text-beige-200">{{ $dest['nama_bandara'] }}</p>
                    </div>
                </div>

                <!-- Konten Kartu -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <p class="text-xs text-mahogany-700/80 leading-relaxed mb-4">
                        {{ $dest['deskripsi'] }}
                    </p>

                    <div class="pt-4 border-t border-beige-200 flex items-center justify-between">
                        <div>
                            <span class="block text-[10px] text-mahogany-500 uppercase tracking-wider">Mulai Dari</span>
                            <span class="font-serif text-lg font-bold text-mahogany-900">{{ $dest['harga_mulai'] }}</span>
                        </div>
                        <a href="{{ route('flights.index', ['destination_id' => \App\Models\Airport::where('kode_bandara', $dest['kode'])->value('id') ?? 2]) }}" 
                           class="px-4 py-2 bg-beige-100 hover:bg-mahogany-700 hover:text-white text-mahogany-800 rounded-xl text-xs font-bold transition-all shadow-sm">
                            Pesan Tiket
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- REKOMENDASI DESTINASI INTERNASIONAL -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8">
        <div>
            <span class="text-xs uppercase font-bold tracking-widest text-gold-600 bg-gold-400/20 px-3 py-1 rounded-md">
                Keliling Dunia
            </span>
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-mahogany-900 mt-2">
                Rekomendasi Destinasi Internasional
            </h2>
            <p class="text-sm text-mahogany-700/80 mt-1">
                Terbang ke kota-kota ikonik dunia dengan maskapai internasional pilihan.
            </p>
        </div>
        <a href="{{ route('flights.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 text-sm font-bold text-mahogany-700 hover:text-mahogany-900 group">
            <span>Lihat Semua Rute Internasional</span>
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($destinasiInternasional as $dest)
            <div class="bg-white rounded-2xl overflow-hidden border border-beige-200 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col">
                <!-- Foto Destinasi -->
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $dest['gambar'] }}" alt="{{ $dest['kota'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-mahogany-950/80 via-transparent to-transparent"></div>
                    
                    <span class="absolute top-4 left-4 bg-mahogany-900/90 text-gold-400 text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm border border-gold-500/20">
                        {{ $dest['tag'] }}
                    </span>

                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h3 class="font-serif text-2xl font-bold">{{ $dest['kota'] }}</h3>
                        <p class="text-xs text-beige-200">{{ $dest['nama_bandara'] }}</p>
                    </div>
                </div>

                <!-- Konten Kartu -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <p class="text-xs text-mahogany-700/80 leading-relaxed mb-4">
                        {{ $dest['deskripsi'] }}
                    </p>

                    <div class="pt-4 border-t border-beige-200 flex items-center justify-between">
                        <div>
                            <span class="block text-[10px] text-mahogany-500 uppercase tracking-wider">Mulai Dari</span>
                            <span class="font-serif text-lg font-bold text-mahogany-900">{{ $dest['harga_mulai'] }}</span>
                        </div>
                        <a href="{{ route('flights.index', ['destination_id' => \App\Models\Airport::where('kode_bandara', $dest['kode'])->value('id') ?? 13]) }}" 
                           class="px-4 py-2 bg-beige-100 hover:bg-mahogany-700 hover:text-white text-mahogany-800 rounded-xl text-xs font-bold transition-all shadow-sm">
                            Pesan Tiket
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- DAFTAR MASKAPAI PENERBANGAN MITRA RESMI -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-t border-beige-200">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <span class="text-xs uppercase font-bold tracking-widest text-mahogany-700 bg-beige-200 px-3 py-1 rounded-md">
            Pilihan Terpercaya
        </span>
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-mahogany-900 mt-2">
            Maskapai Penerbangan Rekanan
        </h2>
        <p class="text-sm text-mahogany-700/80 mt-2">
            Kami bermitra dengan maskapai ternama nasional dan internasional untuk memastikan kenyamanan terbang Anda.
        </p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($airlines as $airline)
            <a href="{{ route('flights.index', ['airline_id' => $airline->id]) }}" 
               class="bg-white p-4 rounded-xl border border-beige-200 shadow-sm hover:shadow-md hover:border-mahogany-700 transition-all flex flex-col items-center justify-center text-center group">
                <div class="h-12 w-full flex items-center justify-center mb-2 overflow-hidden">
                    <img src="{{ asset('images/airlines/' . $airline->logo) }}" alt="{{ $airline->nama_maskapai }}" class="max-h-10 max-w-full object-contain group-hover:scale-105 transition-transform">
                </div>
                <span class="text-xs font-bold text-mahogany-900 group-hover:text-mahogany-700 transition-colors">
                    {{ $airline->nama_maskapai }}
                </span>
                <span class="text-[10px] text-mahogany-500 font-mono mt-0.5">
                    Kode: {{ $airline->kode_maskapai }}
                </span>
            </a>
        @endforeach
    </div>
</section>

<!-- TENTANG KAMI SECTION -->
<section id="tentang-kami" class="bg-gradient-to-b from-beige-100 to-beige-50 py-20 border-t border-beige-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-xs uppercase font-bold tracking-widest text-gold-600 bg-gold-400/20 px-3 py-1 rounded-md">
                    Filosofi Kami
                </span>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-mahogany-900 mt-2 leading-tight">
                    Mewujudkan Setiap Perjalanan Menjadi Kenangan Berharga
                </h2>
                <p class="text-sm text-mahogany-800 leading-relaxed mt-4">
                    <strong>CHERISH TRAVEL</strong> hadir sebagai pionir platform reservasi tiket penerbangan modern di Indonesia yang menggabungkan kemudahan teknologi dengan sentuhan kemewahan dan pelayanan berkelas.
                </p>
                <p class="text-sm text-mahogany-700/80 leading-relaxed mt-3">
                    Kami percaya bahwa setiap detik dalam perjalanan—mulai dari memilih penerbangan, proses pemesanan tiket yang mulus, hingga saat menginjakkan kaki di destinasi impian—layak mendapatkan pengalaman yang istimewa dan bebas dari rasa khawatir.
                </p>

                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="bg-white p-4 rounded-xl border border-beige-300">
                        <span class="font-serif text-3xl font-bold text-mahogany-800">500.000+</span>
                        <p class="text-xs text-mahogany-600 font-medium mt-1">Penumpang Puas</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-beige-300">
                        <span class="font-serif text-3xl font-bold text-mahogany-800">22+</span>
                        <p class="text-xs text-mahogany-600 font-medium mt-1">Rute Bandara Utama</p>
                    </div>
                </div>
            </div>

            <!-- Gambar / Ilustrasi Tentang Kami -->
            <div class="relative">
                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=900&q=80" alt="Layanan Penerbangan Cherish Travel" class="w-full h-96 object-cover">
                </div>
                <div class="absolute -bottom-6 -left-6 bg-mahogany-900 text-white p-6 rounded-2xl shadow-xl border border-gold-500/30 max-w-xs">
                    <div class="flex items-center gap-2 text-gold-400 mb-2">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider">Garansi Kepuasan</span>
                    </div>
                    <p class="text-xs text-beige-200">
                        Komitmen kami menghadirkan transparansi harga tiket dan penerbitan e-ticket resmi tercepat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KONTAK KAMI SECTION -->
<section id="kontak" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center max-w-2xl mx-auto mb-14">
        <span class="text-xs uppercase font-bold tracking-widest text-mahogany-700 bg-beige-200 px-3 py-1 rounded-md">
            Layanan Pelanggan
        </span>
        <h2 class="font-serif text-3xl sm:text-4xl font-bold text-mahogany-900 mt-2">
            Ada Pertanyaan? Hubungi Kami
        </h2>
        <p class="text-sm text-mahogany-700/80 mt-2">
            Tim konsultan perjalanan Cherish Travel siap sedia 24 jam sehari untuk membantu rencana perjalanan Anda.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- INFORMASI KONTAK -->
        <div class="bg-gradient-to-br from-mahogany-900 to-mahogany-950 text-white p-8 rounded-3xl shadow-xl flex flex-col justify-between">
            <div>
                <h3 class="font-serif text-2xl font-bold mb-4 text-gold-400">Kantor Pusat</h3>
                <p class="text-xs text-beige-200/90 leading-relaxed mb-8">
                    Kunjungi kantor representatif kami atau hubungi nomor layanan darurat perjalanan Anda kapan pun.
                </p>

                <div class="space-y-6 text-sm">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-mahogany-800 border border-gold-500/20 flex items-center justify-center text-gold-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs text-gold-400 font-bold uppercase">Alamat</span>
                            <p class="text-xs text-beige-100 mt-0.5">Cherish Tower Lt. 18, Jl. Sudirman No. 88, Jakarta Selatan 12190</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-mahogany-800 border border-gold-500/20 flex items-center justify-center text-gold-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs text-gold-400 font-bold uppercase">Telepon & WhatsApp</span>
                            <p class="text-xs text-beige-100 mt-0.5">+62 (21) 8899-7722 / +62 811-9876-5432</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-mahogany-800 border border-gold-500/20 flex items-center justify-center text-gold-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs text-gold-400 font-bold uppercase">Email Dukungan</span>
                            <p class="text-xs text-beige-100 mt-0.5">cs@cherishtravel.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-mahogany-800 mt-8">
                <span class="text-[11px] text-beige-300">Waktu Operasional:</span>
                <p class="text-xs font-bold text-white mt-1">Senin - Minggu: 24 Jam Nonstop</p>
            </div>
        </div>

        <!-- FORMULIR PESAN / KONTAK -->
        <div class="lg:col-span-2 bg-white p-8 sm:p-10 rounded-3xl border border-beige-200 shadow-md"
             x-data="{ submitted: false, name: '', email: '', message: '' }">
            <h3 class="font-serif text-2xl font-bold text-mahogany-900 mb-2">Kirim Pesan atau Pertanyaan</h3>
            <p class="text-xs text-mahogany-600 mb-6">Kami akan merespons pesan Anda dalam waktu kurang dari 15 menit.</p>

            <div x-show="submitted" class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-6 rounded-2xl mb-6 text-center">
                <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h4 class="font-bold text-base">Terima Kasih!</h4>
                <p class="text-xs mt-1">Pesan Anda telah berhasil diterima oleh tim Cherish Travel. Kami segera menghubungi Anda.</p>
            </div>

            <form x-show="!submitted" @submit.prevent="submitted = true" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-mahogany-700 uppercase mb-1">Nama Lengkap</label>
                        <input type="text" x-model="name" required placeholder="Nama Anda" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl text-sm focus:ring-2 focus:ring-mahogany-700 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-mahogany-700 uppercase mb-1">Alamat Email</label>
                        <input type="email" x-model="email" required placeholder="email@domain.com" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl text-sm focus:ring-2 focus:ring-mahogany-700 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase mb-1">Subjek / Topik</label>
                    <input type="text" required placeholder="Pertanyaan tiket pesawat / pemesanan" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl text-sm focus:ring-2 focus:ring-mahogany-700 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase mb-1">Pesan Anda</label>
                    <textarea rows="4" x-model="message" required placeholder="Tuliskan pertanyaan atau kebutuhan perjalanan Anda secara rinci..." class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl text-sm focus:ring-2 focus:ring-mahogany-700 focus:outline-none"></textarea>
                </div>

                <button type="submit" class="px-8 py-3.5 bg-mahogany-700 hover:bg-mahogany-800 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all shadow-md">
                    Kirim Pesan Sekarang
                </button>
            </form>
        </div>

    </div>
</section>
@endsection
