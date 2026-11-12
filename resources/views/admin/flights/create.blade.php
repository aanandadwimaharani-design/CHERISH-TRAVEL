@extends('admin.layouts.app')

@section('title', 'Tambah Penerbangan - CHERISH TRAVEL')
@section('page_title', 'Tambah Penerbangan Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Tambah Penerbangan</h2>
            <p class="text-mahogany-600 text-sm mt-1">Tambahkan data penerbangan baru ke sistem CHERISH TRAVEL</p>
        </div>
        <a href="{{ route('admin.flights.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-beige-200 p-8 shadow-sm">
        <form method="POST" action="{{ route('admin.flights.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Maskapai</label>
                    <select name="airline_id" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                        <option value="">Pilih maskapai</option>
                        @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}">{{ $airline->nama_maskapai }}</option>
                        @endforeach
                    </select>
                    @error('airline_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Bandara Keberangkatan</label>
                    <select name="airport_origin_id" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                        <option value="">Pilih bandara asal</option>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->id }}">{{ $airport->kode_bandara }} - {{ $airport->kota }}</option>
                        @endforeach
                    </select>
                    @error('airport_origin_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Bandara Tujuan</label>
                    <select name="airport_destination_id" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                        <option value="">Pilih bandara tujuan</option>
                        @foreach ($airports as $airport)
                            <option value="{{ $airport->id }}">{{ $airport->kode_bandara }} - {{ $airport->kota }}</option>
                        @endforeach
                    </select>
                    @error('airport_destination_id') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Nomor Penerbangan</label>
                    <input type="text" name="nomor_penerbangan" value="{{ old('nomor_penerbangan') }}" required placeholder="Contoh: GA-402" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 uppercase">
                    @error('nomor_penerbangan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tanggal Keberangkatan</label>
                    <input type="date" name="tanggal_keberangkatan" value="{{ old('tanggal_keberangkatan') ?? now()->toDateString() }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    @error('tanggal_keberangkatan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Jam Keberangkatan</label>
                    <input type="time" name="jam_keberangkatan" value="{{ old('jam_keberangkatan') }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    @error('jam_keberangkatan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tanggal Kedatangan</label>
                    <input type="date" name="tanggal_kedatangan" value="{{ old('tanggal_kedatangan') ?? now()->toDateString() }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    @error('tanggal_kedatangan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Jam Kedatangan</label>
                    <input type="time" name="jam_kedatangan" value="{{ old('jam_kedatangan') }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    @error('jam_kedatangan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Durasi</label>
                    <input type="text" name="durasi" value="{{ old('durasi') }}" required placeholder="Contoh: 1 Jam 50 Menit" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    @error('durasi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tipe Penerbangan</label>
                    <select name="tipe_penerbangan" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                        <option value="Langsung">Langsung</option>
                        <option value="Transit">Transit</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Kelas Penerbangan</label>
                    <select name="kelas_penerbangan" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                        <option value="Ekonomi">Ekonomi</option>
                        <option value="Bisnis">Bisnis</option>
                        <option value="First Class">First Class</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Harga Tiket</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-mahogany-500">Rp</span>
                        <input type="number" name="harga" value="{{ old('harga') }}" required min="0" step="1000" placeholder="0" class="w-full pl-10 pr-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    </div>
                    @error('harga') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Kapasitas Kursi</label>
                    <input type="number" name="kapasitas_kursi" value="{{ old('kapasitas_kursi') }}" required min="1" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    @error('kapasitas_kursi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Status Penerbangan</label>
                    <select name="status" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                        <option value="Tersedia">Tersedia</option>
                        <option value="Penuh">Penuh</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Terminal</label>
                    <input type="text" name="terminal" value="{{ old('terminal') ?? 'Terminal 1' }}" placeholder="Contoh: Terminal 3" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="flex-1 px-8 py-3.5 bg-mahogany-700 hover:bg-mahogany-800 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    Simpan Penerbangan
                </button>
                <a href="{{ route('admin.flights.index') }}" class="px-6 py-3.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
