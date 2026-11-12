@extends('admin.layouts.app')

@section('title', 'Manajemen Penerbangan - CHERISH TRAVEL')
@section('page_title', 'Manajemen Penerbangan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Data Penerbangan</h2>
            <p class="text-mahogany-600 text-sm mt-1">Kelola jadwal, harga, dan kapasitas kursi penerbangan</p>
        </div>
        <a href="{{ route('admin.flights.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-mahogany-700 hover:bg-mahogany-800 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Penerbangan
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <form method="GET" action="{{ route('admin.flights.index') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="lg:col-span-3">
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-mahogany-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ old('search', request('search')) }}" placeholder="Nomor penerbangan, maskapai, atau kota" class="w-full pl-10 pr-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Maskapai</label>
                <select name="airline_id" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
                    <option value="">Semua Maskapai</option>
                    @foreach ($airlines as $airline)
                        <option value="{{ $airline->id }}" {{ old('airline_id', request('airline_id')) == $airline->id ? 'selected' : '' }}>{{ $airline->nama_maskapai }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Status</label>
                <select name="status" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ old('status', request('status')) == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-6 flex items-end gap-3">
                <button type="submit" class="flex-1 px-6 py-3 bg-mahogany-700 hover:bg-mahogany-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
                    Terapkan Filter
                </button>
                <a href="{{ route('admin.flights.index') }}" class="px-6 py-3 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-beige-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-beige-200">
                <thead class="bg-beige-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Nomor Penerbangan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Maskapai</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Rute</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Jam</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Kapasitas</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-mahogany-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-beige-100">
                    @forelse ($flights as $flight)
                        <tr class="hover:bg-beige-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-mahogany-900 font-mono">{{ $flight->nomor_penerbangan }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $flight->airline->nama_maskapai }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">
                                {{ $flight->origin->kode_bandara }} &rarr; {{ $flight->destination->kode_bandara }}
                            </td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ \Carbon\Carbon::parse($flight->tanggal_keberangkatan)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ \Carbon\Carbon::parse($flight->jam_keberangkatan)->format('H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $flight->kelas_penerbangan }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-mahogany-900">Rp {{ number_format($flight->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $flight->kapasitas_kursi }} kursi</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded text-xs font-bold @switch($flight->status)
                                    @case('Tersedia') bg-emerald-50 text-emerald-700 @break
                                    @case('Penuh') bg-amber-50 text-amber-700 @break
                                    @default bg-red-50 text-red-700 @endswitch">
                                    {{ $flight->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center gap-2 justify-end">
                                    <a href="{{ route('admin.flights.edit', $flight) }}" class="text-sm font-medium text-mahogany-700 hover:text-mahogany-900 flex items-center gap-1.5">
                                        Edit <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.flights.destroy', $flight) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penerbangan ini? Data pemesanan terkait juga akan dihapus.')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900 flex items-center gap-1.5">
                                            Hapus <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-6 py-12 text-center">
                                <p class="text-mahogany-500 text-sm">Belum ada data penerbangan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $flights->links() }}
    </div>
</div>
@endsection
