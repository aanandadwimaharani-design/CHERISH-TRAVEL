@extends('admin.layouts.app')

@section('title', 'Edit Bandara - CHERISH TRAVEL')
@section('page_title', 'Edit Bandara')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Edit Bandara</h2>
            <p class="text-mahogany-600 text-sm mt-1">{{ $airport->nama_bandara }}</p>
        </div>
        <a href="{{ route('admin.airports.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-beige-200 p-8 shadow-sm">
        <form method="POST" action="{{ route('admin.airports.update', $airport) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Kode Bandara</label>
                <input type="text" name="kode_bandara" value="{{ old('kode_bandara', $airport->kode_bandara) }}" required maxlength="10" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 uppercase">
                @error('kode_bandara') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Nama Bandara</label>
                <input type="text" name="nama_bandara" value="{{ old('nama_bandara', $airport->nama_bandara) }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                @error('nama_bandara') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Kota</label>
                <input type="text" name="kota" value="{{ old('kota', $airport->kota) }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                @error('kota') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Negara</label>
                <input type="text" name="negara" value="{{ old('negara', $airport->negara) }}" required class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                @error('negara') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tipe Bandara</label>
                <select name="tipe" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    <option value="domestik" {{ $airport->tipe === 'domestik' ? 'selected' : '' }}>Domestik</option>
                    <option value="internasional" {{ $airport->tipe === 'internasional' ? 'selected' : '' }}>Internasional</option>
                </select>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="flex-1 px-8 py-3.5 bg-mahogany-700 hover:bg-mahogany-800 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    Perbarui Data
                </button>
                <a href="{{ route('admin.airports.index') }}" class="px-6 py-3.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
