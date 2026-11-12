@extends('admin.layouts.app')

@section('title', 'Tambah Maskapai - CHERISH TRAVEL')
@section('page_title', 'Tambah Maskapai')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Tambah Maskapai</h2>
            <p class="text-mahogany-600 text-sm mt-1">Tambahkan maskapai mitra baru</p>
        </div>
        <a href="{{ route('admin.airlines.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-beige-200 p-8 shadow-sm">
        <form method="POST" action="{{ route('admin.airlines.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Nama Maskapai</label>
                <input type="text" name="nama_maskapai" value="{{ old('nama_maskapai') }}" required placeholder="Contoh: Garuda Indonesia" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                @error('nama_maskapai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Kode Maskapai</label>
                <input type="text" name="kode_maskapai" value="{{ old('kode_maskapai') }}" required placeholder="Contoh: GA" maxlength="10" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 uppercase">
                @error('kode_maskapai') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">File Logo</label>
                <input type="text" name="logo" value="{{ old('logo') }}" placeholder="Contoh: garuda.svg" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                @error('logo') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="flex-1 px-8 py-3.5 bg-mahogany-700 hover:bg-mahogany-800 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                    Simpan Maskapai
                </button>
                <a href="{{ route('admin.airlines.index') }}" class="px-6 py-3.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
