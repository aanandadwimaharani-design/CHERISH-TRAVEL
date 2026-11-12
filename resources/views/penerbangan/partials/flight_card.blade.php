<div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm hover:shadow-lg hover:border-mahogany-400 transition-all duration-300">
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        
        <!-- KOLOM 1: MASKAPAI & KELAS -->
        <div class="flex items-center gap-4 lg:w-1/4">
            <div class="w-14 h-12 bg-beige-50 rounded-xl p-1.5 border border-beige-200 flex items-center justify-center flex-shrink-0">
                @if($flight->airline && $flight->airline->logo)
                    <img src="{{ asset('images/airlines/' . $flight->airline->logo) }}" alt="{{ $flight->airline->nama_maskapai }}" class="max-h-full max-w-full object-contain">
                @else
                    <span class="font-bold text-xs text-mahogany-700 font-mono">{{ $flight->airline->kode_maskapai ?? 'AIR' }}</span>
                @endif
            </div>
            <div>
                <h4 class="font-bold text-sm text-mahogany-900 leading-tight">
                    {{ $flight->airline->nama_maskapai ?? 'Maskapai' }}
                </h4>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-xs font-mono font-semibold text-mahogany-600">
                        {{ $flight->nomor_penerbangan }}
                    </span>
                    <span class="inline-block w-1 h-1 rounded-full bg-beige-400"></span>
                    <span class="text-[11px] font-bold text-gold-600 bg-gold-400/20 px-2 py-0.5 rounded">
                        {{ $flight->kelas_penerbangan }}
                    </span>
                </div>
            </div>
        </div>

        <!-- KOLOM 2: WAKTU, JALUR PENERBANGAN & BANDARA -->
        <div class="flex-1 grid grid-cols-7 items-center gap-2 text-center">
            
            <!-- KEBERANGKATAN -->
            <div class="col-span-2 text-left">
                <span class="font-serif text-2xl font-bold text-mahogany-950 block leading-tight">
                    {{ $flight->formatted_jam_keberangkatan }}
                </span>
                <span class="text-xs font-bold text-mahogany-800 block">
                    {{ $flight->origin->kode_bandara }}
                </span>
                <span class="text-[11px] text-mahogany-600 truncate block max-w-[130px]" title="{{ $flight->origin->nama_bandara }}">
                    {{ $flight->origin->kota }}
                </span>
                <span class="text-[10px] text-mahogany-500 block mt-0.5">
                    {{ \Carbon\Carbon::parse($flight->tanggal_keberangkatan)->format('d M Y') }}
                </span>
            </div>

            <!-- DURASI & JALUR PENERBANGAN -->
            <div class="col-span-3 flex flex-col items-center px-2">
                <span class="text-[11px] font-medium text-mahogany-600 mb-1">
                    {{ $flight->durasi }}
                </span>
                <div class="w-full flex items-center justify-center relative">
                    <div class="w-full h-0.5 bg-beige-300"></div>
                    <div class="absolute w-2 h-2 rounded-full bg-mahogany-700 left-0"></div>
                    <!-- Ikon Pesawat di Tengah -->
                    <div class="absolute bg-white px-1">
                        <svg class="w-4 h-4 text-mahogany-700 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <div class="absolute w-2 h-2 rounded-full bg-mahogany-700 right-0"></div>
                </div>
                <span class="text-[10px] font-semibold mt-1 px-2 py-0.5 rounded {{ $flight->tipe_penerbangan === 'Langsung' ? 'text-emerald-700 bg-emerald-50' : 'text-amber-800 bg-amber-50' }}">
                    {{ $flight->tipe_penerbangan }}
                </span>
            </div>

            <!-- KEDATANGAN -->
            <div class="col-span-2 text-right">
                <span class="font-serif text-2xl font-bold text-mahogany-950 block leading-tight">
                    {{ $flight->formatted_jam_kedatangan }}
                </span>
                <span class="text-xs font-bold text-mahogany-800 block">
                    {{ $flight->destination->kode_bandara }}
                </span>
                <span class="text-[11px] text-mahogany-600 truncate block max-w-[130px] ml-auto" title="{{ $flight->destination->nama_bandara }}">
                    {{ $flight->destination->kota }}
                </span>
                <span class="text-[10px] text-mahogany-500 block mt-0.5">
                    {{ \Carbon\Carbon::parse($flight->tanggal_kedatangan)->format('d M Y') }}
                </span>
            </div>

        </div>

        <!-- KOLOM 3: FASILITAS, HARGA & TOMBOL PILIH -->
        <div class="lg:w-1/4 flex flex-col lg:items-end justify-between pt-4 lg:pt-0 border-t lg:border-t-0 border-beige-200">
            <div class="text-left lg:text-right mb-3">
                <span class="text-[11px] text-mahogany-500 block">Mulai Dari / Orang</span>
                <span class="font-serif text-2xl font-bold text-mahogany-900 block leading-tight">
                    {{ $flight->formatted_harga }}
                </span>
                
                <!-- SISA KURSI -->
                <div class="mt-1">
                    @if($flight->sisa_kursi <= 5 && $flight->sisa_kursi > 0)
                        <span class="text-[11px] font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded-full inline-block animate-pulse">
                            Sisa {{ $flight->sisa_kursi }} Kursi Lagi!
                        </span>
                    @elseif($flight->sisa_kursi <= 0)
                        <span class="text-[11px] font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full inline-block">
                            Kursi Penuh
                        </span>
                    @else
                        <span class="text-[11px] font-medium text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full inline-block">
                            Tersedia {{ $flight->sisa_kursi }} Kursi
                        </span>
                    @endif
                </div>
            </div>

            <!-- Tombol Pilih Penerbangan -->
            @if($flight->sisa_kursi >= $passengers)
                <a href="{{ route('booking.create', ['flight_id' => $flight->id, 'passengers' => $passengers, 'trip_type' => (request('trip_type') === 'round_trip' || (isset($tripType) && $tripType === 'round_trip')) ? 'Pulang-Pergi' : 'Sekali Jalan']) }}" 
                   class="w-full lg:w-auto px-6 py-2.5 bg-gradient-to-r from-mahogany-700 to-mahogany-800 hover:from-mahogany-800 hover:to-mahogany-900 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                    <span>Pilih Penerbangan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            @else
                <button disabled class="w-full lg:w-auto px-6 py-2.5 bg-gray-200 text-gray-400 rounded-xl text-xs font-bold uppercase tracking-wider cursor-not-allowed">
                    Kursi Tidak Cukup
                </button>
            @endif
        </div>

    </div>

    <!-- FITUR FASILITAS KECIL (BAGASI, MAKANAN, USB) -->
    <div class="mt-4 pt-3 border-t border-beige-100 flex flex-wrap items-center justify-between text-[11px] text-mahogany-600 gap-3">
        <div class="flex items-center gap-4">
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-mahogany-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Kabin 7kg + Bagasi 20kg
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-mahogany-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                {{ $flight->terminal ?? 'Terminal Utama' }}
            </span>
        </div>
        <div class="text-[10px] text-mahogany-500">
            Nomor Penerbangan Resmi: <strong class="text-mahogany-700 font-mono">{{ $flight->nomor_penerbangan }}</strong>
        </div>
    </div>
</div>
