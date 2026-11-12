@extends('admin.layouts.app')

@section('title', 'Detail Pemesanan - CHERISH TRAVEL')
@section('page_title', 'Detail Pemesanan')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Detail Pemesanan</h2>
            <p class="text-mahogany-600 text-sm mt-1">Kode Booking: <span class="font-bold text-mahogany-900">{{ $booking->kode_booking }}</span></p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2.5 bg-white border border-beige-300 text-mahogany-700 font-semibold rounded-xl hover:bg-beige-50 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
            <a href="{{ route('ticket.show', $booking->kode_booking) }}" target="_blank" class="px-4 py-2.5 bg-mahogany-700 hover:bg-mahogany-800 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                Lihat E-Ticket
            </a>
        </div>
    </div>

    <!-- Info Booking -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-4">Informasi Pemesanan</h3>
            <dl class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-mahogany-50 flex items-center justify-center text-mahogany-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Kode Booking</p>
                        <p class="text-sm font-medium text-mahogany-900">{{ $booking->kode_booking }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-mahogany-50 flex items-center justify-center text-mahogany-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m0 0h.01M9 16h9a9 9 0 00-9-9z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Tanggal Transaksi</p>
                        <p class="text-sm font-medium text-mahogany-900">{{ $booking->created_at->format('d F Y, H:i:s') }} WIB</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-mahogany-50 flex items-center justify-center text-mahogany-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Status Pemesanan</p>
                        <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold @switch($booking->status_pemesanan)
                            @case('Terkonfirmasi') bg-emerald-100 text-emerald-700 @break
                            @case('Lunas') bg-blue-100 text-blue-700 @break
                            @default bg-amber-100 text-amber-700 @endswitch">
                            {{ $booking->status_pemesanan }}
                        </span>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg bg-mahogany-50 flex items-center justify-center text-mahogany-700 text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Tipe Perjalanan</p>
                        <p class="text-sm font-medium text-mahogany-900">{{ $booking->tipe_perjalanan }}</p>
                    </div>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm lg:col-span-2">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-4">QR Code E-Ticket</h3>
            <p class="text-xs text-mahogany-500 mb-4">Scan QR code atau kunjungi tautan untuk memverifikasi e-ticket resmi.</p>
            <div class="flex flex-col items-center justify-center bg-beige-50 rounded-xl p-6 border border-beige-200">
                <div class="w-48 h-48 bg-white p-2 rounded-lg border border-beige-200 mb-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ urlencode($qrData) }}" alt="QR Code" class="w-full h-full object-contain" onerror="this.src='https://chart.googleapis.com/chart?chs=400x400&chl={{ urlencode($qrData) }}&choe=UTF-8&chld=L|2'">
                </div>
                <p class="text-sm text-mahogany-900 font-medium">{{ $booking->kode_booking }}</p>
                <p class="text-xs text-mahogany-500 mt-1">{{ $qrData }}</p>
            </div>
        </div>
    </div>

    <!-- Detail Penerbangan & Rute -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-4">Detail Penerbangan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="text-center">
                        <div class="text-sm font-bold text-mahogany-900">{{ $booking->flight->origin->kode_bandara }}</div>
                        <div class="text-xs text-mahogany-500">{{ $booking->flight->origin->kota }}</div>
                    </div>
                    <div class="flex-grow flex items-center justify-center">
                        <div class="w-full h-px bg-beige-200 mx-4"></div>
                        <svg class="w-5 h-5 text-mahogany-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <div class="w-full h-px bg-beige-200 mx-4"></div>
                    </div>
                    <div class="text-center">
                        <div class="text-sm font-bold text-mahogany-900">{{ $booking->flight->destination->kode_bandara }}</div>
                        <div class="text-xs text-mahogany-500">{{ $booking->flight->destination->kota }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Tanggal Berangkat</p>
                        <p class="text-sm text-mahogany-900">{{ $booking->flight->tanggal_keberangkatan->format('d F Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Jam Berangkat</p>
                        <p class="text-sm text-mahogany-900">{{ \Carbon\Carbon::parse($booking->flight->jam_keberangkatan)->format('H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Maskapai</p>
                        <p class="text-sm text-mahogany-900">{{ $booking->flight->airline->nama_maskapai }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-mahogany-600 uppercase">Nomor Penerbangan</p>
                        <p class="text-sm text-mahogany-900">{{ $booking->flight->nomor_penerbangan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Penumpang -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-serif font-bold text-lg text-mahogany-900">Data Penumpang</h3>
            <span class="text-xs font-bold text-mahogany-600 uppercase">{{ $booking->passengers->count() }} penumpang</span>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-beige-200">
                <thead class="bg-beige-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">No. Identitas</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">No. Kursi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Bagasi Tambahan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-mahogany-600 uppercase tracking-wider">Biaya Bagasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-beige-100">
                    @forelse ($booking->passengers as $passenger)
                        <tr>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $passenger->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $passenger->jenis_kelamin }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ \Carbon\Carbon::parse($passenger->tanggal_lahir)->format('d F Y') }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900 font-mono">{{ $passenger->nomor_identitas }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $passenger->nomor_kursi ?? 'Belum ditentukan' }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">{{ $passenger->bagasi_tambahan }}</td>
                            <td class="px-6 py-4 text-sm text-mahogany-900">Rp {{ number_format($passenger->biaya_bagasi, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-mahogany-500 text-sm">Belum ada data penumpang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rincian Harga -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-4">Rincian Harga &amp; Pembayaran</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border border-beige-200 rounded-xl p-4">
                <p class="text-xs font-bold text-mahogany-600 uppercase">Harga Dasar per Penumpang</p>
                <p class="text-sm font-medium text-mahogany-900 mt-1">Rp {{ number_format($booking->total_harga / $booking->jumlah_penumpang, 0, ',', '.') }}</p>
            </div>
            <div class="border border-beige-200 rounded-xl p-4">
                <p class="text-xs font-bold text-mahogany-600 uppercase">Jumlah Penumpang</p>
                <p class="text-sm font-medium text-mahogany-900 mt-1">{{ $booking->jumlah_penumpang }} orang</p>
            </div>
            <div class="border border-beige-200 rounded-xl p-4 bg-emerald-50">
                <p class="text-xs font-bold text-emerald-700 uppercase">Total Pembayaran</p>
                <p class="text-sm font-bold text-mahogany-900 mt-1">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
