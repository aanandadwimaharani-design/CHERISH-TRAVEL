@extends('admin.layouts.app')

@section('title', 'Manajemen Pemesanan - CHERISH TRAVEL')
@section('page_title', 'Manajemen Pemesanan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Data Pemesanan Tiket</h2>
            <p class="text-mahogany-600 text-sm mt-1">Kelola seluruh data pemesanan pelanggan CHERISH TRAVEL</p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-mahogany-700 hover:bg-mahogany-800 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Semua Pemesanan
        </a>
    </div>

    <!-- Filter & Pencarian -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div class="lg:col-span-3">
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Pencarian</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-mahogany-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ old('search', request('search')) }}" placeholder="Kode booking, nama, atau email pemesan" class="w-full pl-10 pr-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tanggal Dari</label>
                <input type="date" name="date_from" value="{{ old('date_from', request('date_from')) }}" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tanggal Sampai</label>
                <input type="date" name="date_to" value="{{ old('date_to', request('date_to')) }}" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Status Pemesanan</label>
                <select name="status" value="{{ old('status', request('status')) }}" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
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
                <a href="{{ route('admin.bookings.index') }}" class="px-6 py-3 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Tabel Data -->
    <div class="bg-white rounded-2xl border border-beige-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-beige-200">
                <thead class="bg-beige-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Kode Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Nama Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">No. HP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Maskapai</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Rute</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Tanggal Berangkat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Jumlah Penumpang</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-mahogany-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-beige-100">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-beige-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-mahogany-900">{{ $booking->kode_booking }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-mahogany-900">{{ $booking->nama_pemesan }}</div>
                                <div class="text-xs text-mahogany-500">{{ $booking->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->nomor_hp }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->flight->airline->nama_maskapai }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">
                                {{ $booking->flight->origin->kota }} &rarr; {{ $booking->flight->destination->kota }}
                            </td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->flight->tanggal_keberangkatan->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->jumlah_penumpang }} orang</td>
                            <td class="px-6 py-4 text-sm font-medium text-mahogany-900">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded text-xs font-bold @switch($booking->status_pemesanan)
                                    @case('Terkonfirmasi') bg-emerald-50 text-emerald-700 @break
                                    @case('Lunas') bg-blue-50 text-blue-700 @break
                                    @default bg-amber-50 text-amber-700 @endswitch">
                                    {{ $booking->status_pemesanan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <a href="{{ route('admin.bookings.show', $booking->kode_booking) }}" class="text-sm font-medium text-mahogany-700 hover:text-mahogany-900 flex items-center gap-1.5">
                                    Detail <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center">
                                <p class="text-mahogany-500 text-sm">Belum ada data pemesanan yang cocok.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $bookings->links() }}
    </div>
</div>
@endsection
