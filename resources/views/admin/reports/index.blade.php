@extends('admin.layouts.app')

@section('title', 'Laporan Pemesanan - CHERISH TRAVEL')
@section('page_title', 'Laporan Pemesanan & Transaksi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Laporan Pemesanan</h2>
            <p class="text-mahogany-600 text-sm mt-1">Laporan seluruh transaksi pemesanan pelanggan CHERISH TRAVEL</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.reports.print') . '?' . http_build_query(request()->only(['date_from', 'date_to', 'airline_id', 'status'])) }}" 
               class="px-4 py-2.5 bg-mahogany-700 hover:bg-mahogany-800 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Cetak
            </a>
            <a href="{{ route('admin.reports.excel') . '?' . http_build_query(request()->only(['date_from', 'date_to', 'airline_id', 'status'])) }}" 
               class="px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Excel
            </a>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <form method="GET" action="{{ route('admin.reports.index') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tanggal Dari</label>
                <input type="date" name="date_from" value="{{ old('date_from', request('date_from')) }}" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Tanggal Sampai</label>
                <input type="date" name="date_to" value="{{ old('date_to', request('date_to')) }}" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
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
                <label class="block text-xs font-bold text-mahogany-700 uppercase tracking-wider mb-2">Status Pemesanan</label>
                <select name="status" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900 text-sm">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ old('status', request('status')) == $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-6 flex items-end gap-3">
                <button type="submit" class="flex-1 px-6 py-3 bg-mahogany-700 hover:bg-mahogany-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
                    Tampilkan Laporan
                </button>
                <a href="{{ route('admin.reports.index') }}" class="px-6 py-3 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Ringkasan Pendapatan -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-serif font-bold text-lg text-mahogany-900">Ringkasan Laporan</h3>
            <div class="text-right">
                <p class="text-xs font-bold text-mahogany-500 uppercase">Total Pendapatan (Berhasil)</p>
                <p class="text-2xl font-bold text-mahogany-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Tabel Laporan -->
    <div class="bg-white rounded-2xl border border-beige-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-beige-200">
                <thead class="bg-beige-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Kode Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Tanggal Transaksi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Nama Pemesan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Maskapai</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Rute</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Tanggal Berangkat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Jumlah Penumpang</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-beige-100">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-beige-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-mahogany-900 font-mono">{{ $booking->kode_booking }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->nama_pemesan }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->flight->airline->nama_maskapai }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->flight->origin->kode_bandara }} &rarr; {{ $booking->flight->destination->kode_bandara }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ \Carbon\Carbon::parse($booking->flight->tanggal_keberangkatan)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $booking->jumlah_penumpang }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-mahogany-900">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded text-xs font-bold @switch($booking->status_pemesanan)
                                    @case('Terkonfirmasi') bg-emerald-50 text-emerald-700 @break
                                    @case('Lunas') bg-blue-50 text-blue-700 @break
                                    @default bg-amber-50 text-amber-700 @endswitch">
                                    {{ $booking->status_pemesanan }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <p class="text-mahogany-500 text-sm">Belum ada data transaksi yang cocok dengan filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
