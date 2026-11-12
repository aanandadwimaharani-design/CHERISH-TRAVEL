@extends('layouts.app')

@section('title', 'Pemesanan Tiket - ' . $flight->airline->nama_maskapai . ' (' . $flight->nomor_penerbangan . ')')

@section('content')
<!-- PROGRESS BREADCRUMB / STEPS -->
<div class="bg-gradient-to-r from-mahogany-900 to-mahogany-950 text-white py-6 border-b border-gold-500/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-serif text-2xl sm:text-3xl font-bold">Pemesanan Tiket Pesawat</h1>
                <p class="text-xs text-beige-300 mt-1">Lengkapi data kontak pemesan dan penumpang resmi</p>
            </div>
            
            <!-- STEP INDICATOR -->
            <div class="hidden md:flex items-center gap-3 text-xs font-semibold">
                <div class="flex items-center gap-2 text-beige-300">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[11px] font-bold">✓</span>
                    <span>1. Pilih Penerbangan</span>
                </div>
                <div class="w-8 h-0.5 bg-gold-500"></div>
                <div class="flex items-center gap-2 text-white font-bold">
                    <span class="w-6 h-6 rounded-full bg-gold-500 text-mahogany-950 flex items-center justify-center text-[11px] font-bold">2</span>
                    <span>2. Data Pemesanan</span>
                </div>
                <div class="w-8 h-0.5 bg-white/20"></div>
                <div class="flex items-center gap-2 text-beige-400">
                    <span class="w-6 h-6 rounded-full bg-white/10 text-beige-400 flex items-center justify-center text-[11px]">3</span>
                    <span>3. E-Ticket Resmi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10"
     x-data="{
        ticketPrice: {{ $flight->harga }},
        passengerCount: {{ $passengersCount }},
        passengers: [
            @for($i = 0; $i < $passengersCount; $i++)
            {
                nama_lengkap: '{{ old("passengers.$i.nama_lengkap", "") }}',
                jenis_kelamin: '{{ old("passengers.$i.jenis_kelamin", "Laki-laki") }}',
                tanggal_lahir: '{{ old("passengers.$i.tanggal_lahir", "") }}',
                nomor_identitas: '{{ old("passengers.$i.nomor_identitas", "") }}',
                nomor_kursi: '{{ old("passengers.$i.nomor_kursi", (12 + $i) . "A") }}',
                bagasi_pilihan: '0',
                biaya_bagasi: 0
            }{{ $i < $passengersCount - 1 ? ',' : '' }}
            @endfor
        ],
        updateBagasi(index, option) {
            let fee = 0;
            let label = '0 kg (Gratis Kabin 7kg + Bagasi 20kg)';
            if (option === '5') { fee = 120000; label = '+5 kg Ekstra Bagasi'; }
            else if (option === '10') { fee = 220000; label = '+10 kg Ekstra Bagasi'; }
            else if (option === '20') { fee = 400000; label = '+20 kg Ekstra Bagasi'; }

            this.passengers[index].bagasi_pilihan = option;
            this.passengers[index].biaya_bagasi = fee;
            this.passengers[index].bagasi_label = label;
        },
        getTotalBaggageFee() {
            return this.passengers.reduce((sum, p) => sum + (p.biaya_bagasi || 0), 0);
        },
        getTotalPrice() {
            return (this.ticketPrice * this.passengerCount) + this.getTotalBaggageFee();
        },
        formatRupiah(number) {
            return 'Rp ' + Number(number).toLocaleString('id-ID');
        }
     }">

    <form action="{{ route('booking.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf
        <input type="hidden" name="flight_id" value="{{ $flight->id }}">
        <input type="hidden" name="jumlah_penumpang" :value="passengerCount">
        <input type="hidden" name="tipe_perjalanan" value="{{ $tripType }}">

        <!-- KOLOM KIRI: FORMULIR DATA PEMESAN & PENUMPANG (8 COLS) -->
        <div class="lg:col-span-8 space-y-8">
            
            <!-- 1. DETAIL PENERBANGAN TERPILIH (CARD) -->
            <div class="bg-white rounded-2xl border border-beige-300 p-6 shadow-sm">
                <div class="flex items-center justify-between pb-4 border-b border-beige-200 mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-beige-100 flex items-center justify-center p-1.5 border border-beige-300">
                            @if($flight->airline && $flight->airline->logo)
                                <img src="{{ asset('images/airlines/' . $flight->airline->logo) }}" alt="{{ $flight->airline->nama_maskapai }}" class="max-h-full max-w-full object-contain">
                            @else
                                <span class="font-bold text-xs text-mahogany-700 font-mono">{{ $flight->airline->kode_maskapai }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold text-mahogany-900">{{ $flight->airline->nama_maskapai }}</h3>
                            <p class="text-xs text-mahogany-600 font-mono">{{ $flight->nomor_penerbangan }} • {{ $flight->kelas_penerbangan }} • {{ $flight->terminal ?? 'Terminal Utama' }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">
                        {{ $flight->tipe_penerbangan }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                    <div>
                        <span class="text-xs text-mahogany-500 block">Keberangkatan</span>
                        <span class="font-serif text-2xl font-bold text-mahogany-950 block mt-0.5">{{ $flight->formatted_jam_keberangkatan }}</span>
                        <span class="text-sm font-bold text-mahogany-800 block">{{ $flight->origin->kota }} ({{ $flight->origin->kode_bandara }})</span>
                        <span class="text-xs text-mahogany-600 block">{{ $flight->origin->nama_bandara }}</span>
                        <span class="text-xs text-mahogany-500 mt-1 block font-medium">{{ \Carbon\Carbon::parse($flight->tanggal_keberangkatan)->translatedFormat('l, d F Y') }}</span>
                    </div>

                    <div class="text-center py-2 flex flex-col items-center">
                        <span class="text-xs font-semibold text-mahogany-600 mb-1">Durasi: {{ $flight->durasi }}</span>
                        <div class="w-full flex items-center justify-center relative">
                            <div class="w-full h-0.5 bg-beige-300"></div>
                            <div class="absolute bg-white px-2">
                                <svg class="w-5 h-5 text-mahogany-700 transform rotate-90" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                                </svg>
                            </div>
                        </div>
                        <span class="text-[11px] text-mahogany-500 mt-2">Bebas Bagasi Kabin 7kg & Bagasi 20kg</span>
                    </div>

                    <div class="text-left md:text-right">
                        <span class="text-xs text-mahogany-500 block">Kedatangan</span>
                        <span class="font-serif text-2xl font-bold text-mahogany-950 block mt-0.5">{{ $flight->formatted_jam_kedatangan }}</span>
                        <span class="text-sm font-bold text-mahogany-800 block">{{ $flight->destination->kota }} ({{ $flight->destination->kode_bandara }})</span>
                        <span class="text-xs text-mahogany-600 block">{{ $flight->destination->nama_bandara }}</span>
                        <span class="text-xs text-mahogany-500 mt-1 block font-medium">{{ \Carbon\Carbon::parse($flight->tanggal_kedatangan)->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- 2. FORM DATA KONTAK PEMESAN -->
            <div class="bg-white rounded-2xl border border-beige-300 p-6 shadow-sm">
                <div class="flex items-center gap-3 pb-4 border-b border-beige-200 mb-6">
                    <div class="w-8 h-8 rounded-lg bg-mahogany-700 text-white flex items-center justify-center font-bold text-sm">
                        1
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-mahogany-900">Data Kontak Pemesan</h3>
                        <p class="text-xs text-mahogany-600">E-Ticket dan pemberitahuan status penerbangan akan dikirim ke kontak ini.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                            Nama Lengkap Pemesan (Sesuai KTP / Paspor) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="nama_pemesan" 
                               value="{{ old('nama_pemesan') }}" 
                               required 
                               placeholder="Contoh: Raden Surya Pratama" 
                               class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                            Alamat Email Aktif <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="nama@email.com" 
                               class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                            Nomor Handphone / WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" 
                               name="nomor_hp" 
                               value="{{ old('nomor_hp') }}" 
                               required 
                               placeholder="081234567890" 
                               class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                    </div>
                </div>
            </div>

            <!-- 3. FORM DATA PENUMPANG (DINAMIS SESUAI JUMLAH PENUMPANG) -->
            <div class="space-y-6">
                @for($i = 0; $i < $passengersCount; $i++)
                    <div class="bg-white rounded-2xl border border-beige-300 p-6 shadow-sm">
                        <div class="flex items-center justify-between pb-4 border-b border-beige-200 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-mahogany-700 text-white flex items-center justify-center font-bold text-sm">
                                    {{ $i + 2 }}
                                </div>
                                <div>
                                    <h3 class="font-serif text-lg font-bold text-mahogany-900">
                                        Data Penumpang {{ $i + 1 }}
                                    </h3>
                                    <p class="text-xs text-mahogany-600">Pastikan nama dan nomor identitas sama persis dengan kartu identitas resmi</p>
                                </div>
                            </div>
                            <span class="text-xs font-semibold px-3 py-1 bg-beige-100 text-mahogany-800 rounded-lg">
                                Penumpang Dewasa
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            
                            <!-- NAMA LENGKAP PENUMPANG -->
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                                    Nama Lengkap Penumpang <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="passengers[{{ $i }}][nama_lengkap]" 
                                       x-model="passengers[{{ $i }}].nama_lengkap" 
                                       required 
                                       placeholder="Nama Lengkap sesuai KTP / Paspor" 
                                       class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                            </div>

                            <!-- JENIS KELAMIN -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <select name="passengers[{{ $i }}][jenis_kelamin]" 
                                        x-model="passengers[{{ $i }}].jenis_kelamin" 
                                        required 
                                        class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                                    <option value="Laki-laki">Laki-laki (Tuan)</option>
                                    <option value="Perempuan">Perempuan (Nyonya / Nona)</option>
                                </select>
                            </div>

                            <!-- TANGGAL LAHIR -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="passengers[{{ $i }}][tanggal_lahir]" 
                                       x-model="passengers[{{ $i }}].tanggal_lahir" 
                                       max="{{ date('Y-m-d', strtotime('-2 years')) }}" 
                                       required 
                                       class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                            </div>

                            <!-- NOMOR IDENTITAS (KTP / PASPOR) -->
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                                    Nomor Identitas (NIK KTP / Paspor) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="passengers[{{ $i }}][nomor_identitas]" 
                                       x-model="passengers[{{ $i }}].nomor_identitas" 
                                       required 
                                       placeholder="16 Digit NIK KTP atau Nomor Paspor Resmi" 
                                       class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                            </div>

                            <!-- PILIHAN KURSI -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5 flex items-center justify-between">
                                    <span>Pilihan Kursi</span>
                                    <span class="text-[10px] text-emerald-700 font-semibold">Tersedia</span>
                                </label>
                                <select name="passengers[{{ $i }}][nomor_kursi]" 
                                        x-model="passengers[{{ $i }}].nomor_kursi" 
                                        class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all font-mono">
                                    @foreach($availableSeats as $seat)
                                        @if(!$seat['is_occupied'])
                                            <option value="{{ $seat['number'] }}">Kursi {{ $seat['number'] }} ({{ in_array(substr($seat['number'], -1), ['A', 'F']) ? 'Jendela' : (in_array(substr($seat['number'], -1), ['C', 'D']) ? 'Lorong' : 'Tengah') }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- PILIHAN BAGASI TAMBAHAN -->
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-mahogany-800 mb-1.5">
                                    Tambahan Bagasi
                                </label>
                                <select name="passengers[{{ $i }}][bagasi_option]" 
                                        @change="updateBagasi({{ $i }}, $event.target.value)" 
                                        class="w-full px-4 py-3 bg-beige-50/60 border border-beige-300 rounded-xl text-sm font-semibold text-mahogany-900 focus:outline-none focus:ring-2 focus:ring-mahogany-700 focus:bg-white transition-all">
                                    <option value="0">0 kg (+Rp 0 / Gratis)</option>
                                    <option value="5">+5 kg Ekstra (+Rp 120.000)</option>
                                    <option value="10">+10 kg Ekstra (+Rp 220.000)</option>
                                    <option value="20">+20 kg Ekstra (+Rp 400.000)</option>
                                </select>
                                <input type="hidden" name="passengers[{{ $i }}][bagasi_tambahan]" :value="passengers[{{ $i }}].bagasi_label || '0 kg (Gratis Kabin 7kg + Bagasi 20kg)'">
                                <input type="hidden" name="passengers[{{ $i }}][biaya_bagasi]" :value="passengers[{{ $i }}].biaya_bagasi">
                            </div>

                        </div>
                    </div>
                @endfor
            </div>

        </div>

        <!-- KOLOM KANAN: RINGKASAN PEMESANAN SECARA REAL-TIME (4 COLS STICKY) -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-2xl border border-beige-300 p-6 shadow-xl sticky top-28 space-y-6">
                
                <div class="pb-4 border-b border-beige-200">
                    <span class="text-[11px] font-bold text-gold-600 uppercase tracking-widest block">Ringkasan Pemesanan</span>
                    <h3 class="font-serif text-2xl font-bold text-mahogany-900 mt-1">Detail Rincian Biaya</h3>
                </div>

                <!-- RUTE RINGKAS -->
                <div class="bg-beige-50 p-4 rounded-xl border border-beige-200 space-y-2 text-xs">
                    <div class="flex items-center justify-between text-mahogany-900 font-bold">
                        <span>{{ $flight->origin->kota }} ({{ $flight->origin->kode_bandara }})</span>
                        <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                        <span>{{ $flight->destination->kota }} ({{ $flight->destination->kode_bandara }})</span>
                    </div>
                    <div class="flex items-center justify-between text-mahogany-600">
                        <span>{{ $flight->airline->nama_maskapai }} ({{ $flight->nomor_penerbangan }})</span>
                        <span class="font-medium">{{ $flight->kelas_penerbangan }}</span>
                    </div>
                    <div class="text-mahogany-500 pt-1 border-t border-beige-200">
                        {{ \Carbon\Carbon::parse($flight->tanggal_keberangkatan)->translatedFormat('l, d F Y') }} • {{ $flight->formatted_jam_keberangkatan }}
                    </div>
                </div>

                <!-- RINCIAN HARGA REAL-TIME -->
                <div class="space-y-3 text-xs text-mahogany-800">
                    <!-- Harga Tiket x Penumpang -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">Tiket Pesawat (x<span x-text="passengerCount"></span>)</span>
                            <span class="block text-[10px] text-mahogany-500">{{ $flight->formatted_harga }} / orang</span>
                        </div>
                        <span class="font-bold text-sm text-mahogany-900" x-text="formatRupiah(ticketPrice * passengerCount)"></span>
                    </div>

                    <!-- Tambahan Ekstra Bagasi -->
                    <div class="flex items-center justify-between pt-2 border-t border-beige-200" x-show="getTotalBaggageFee() > 0">
                        <div>
                            <span class="font-medium">Total Tambahan Bagasi</span>
                            <span class="block text-[10px] text-mahogany-500">Pilihan ekstra bagasi penumpang</span>
                        </div>
                        <span class="font-bold text-sm text-mahogany-900" x-text="formatRupiah(getTotalBaggageFee())"></span>
                    </div>

                    <!-- Pajak & Biaya Pelayanan (Included) -->
                    <div class="flex items-center justify-between pt-2 border-t border-beige-200">
                        <div>
                            <span class="font-medium">Pajak Bandara (PSC) & PPN</span>
                            <span class="block text-[10px] text-emerald-600 font-semibold">Sudah Termasuk</span>
                        </div>
                        <span class="font-bold text-xs text-emerald-700">Rp 0 (Gratis)</span>
                    </div>
                </div>

                <!-- TOTAL HARGA REAL-TIME BESAR -->
                <div class="pt-4 border-t-2 border-beige-300">
                    <span class="text-xs text-mahogany-600 uppercase tracking-wider block font-bold">Total Pembayaran</span>
                    <span class="font-serif text-3xl font-extrabold text-mahogany-900 block leading-tight mt-1" x-text="formatRupiah(getTotalPrice())"></span>
                    <span class="text-[10px] text-mahogany-500 mt-1 block">Harga final transparan tanpa biaya siluman</span>
                </div>

                <!-- JAMINAN AMAN -->
                <div class="p-3 bg-beige-50 rounded-xl border border-beige-200 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-mahogany-700 text-gold-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <p class="text-[11px] text-mahogany-800 leading-snug">
                        <strong>Simulasi Pemesanan Aman:</strong> E-Ticket resmi akan langsung diterbitkan setelah Anda konfirmasi.
                    </p>
                </div>

                <!-- TOMBOL KONFIRMASI PEMESANAN -->
                <button type="submit" 
                        class="w-full py-4 rounded-xl font-bold uppercase tracking-wider text-sm bg-gradient-to-r from-mahogany-700 via-mahogany-800 to-mahogany-900 hover:from-mahogany-800 hover:to-mahogany-950 text-white shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center justify-center gap-2">
                    <span>Konfirmasi Pemesanan</span>
                    <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>

                <p class="text-[10px] text-center text-mahogany-500">
                    Dengan mengklik tombol di atas, Anda menyetujui Ketentuan Penerbangan Cherish Travel.
                </p>

            </div>
        </div>

    </form>
</div>
@endsection
