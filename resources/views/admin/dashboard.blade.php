@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - CHERISH TRAVEL')
@section('page_title', 'Dashboard Admin')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="font-serif font-bold text-2xl text-mahogany-900">Ringkasan Bisnis</h2>
            <p class="text-mahogany-600 text-sm mt-1">Selamat datang kembali, {{ Auth::user()->name }} &bull; {{ now()->format('l, d F Y') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sistem Aktif
            </span>
        </div>
    </div>

    <!-- Seksi 1: Pemesanan -->
    <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
        <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-6 flex items-center gap-2">
            <svg class="w-5 h-5 text-mahogany-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Pemesanan Tiket
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-mahogany-50 rounded-xl p-5 border border-mahogany-100">
                <p class="text-xs font-bold text-mahogany-500 uppercase tracking-wider mb-2">Total Pemesanan</p>
                <p class="font-serif font-bold text-3xl text-mahogany-900">{{ number_format($totalBookings) }}</p>
                <p class="text-xs text-mahogany-500 mt-2">Seluruh data booking pelanggan</p>
            </div>
            <div class="bg-emerald-50 rounded-xl p-5 border border-emerald-100">
                <p class="text-xs font-bold text-emerald-500 uppercase tracking-wider mb-2">Pemesanan Hari Ini</p>
                <p class="font-serif font-bold text-3xl text-emerald-700">{{ number_format($bookingsToday) }}</p>
                <p class="text-xs text-emerald-500 mt-2">Transaksi yang terjadi hari ini</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
                <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-2">Total Penumpang</p>
                <p class="font-serif font-bold text-3xl text-blue-700">{{ number_format($totalPassengers) }}</p>
                <p class="text-xs text-blue-500 mt-2">Jumlah penumpang terdaftar</p>
            </div>
        </div>
    </div>

    <!-- Seksi 2: Pendapatan & Penerbangan -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Pendapatan
            </h3>
            <div class="bg-gold-50 rounded-xl p-6 border border-gold-100">
                <p class="text-xs font-bold text-gold-500 uppercase tracking-wider mb-1">Total Pendapatan (Berhasil)</p>
                <p class="font-serif font-bold text-4xl text-mahogany-900 mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-xs text-gold-500 mt-2">Hanya menghitung transaksi Terkonfirmasi dan Lunas</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-mahogany-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Penerbangan
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 rounded-xl p-5 border border-blue-100">
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-2">Tersedia</p>
                    <p class="font-serif font-bold text-3xl text-blue-700">{{ number_format($availableFlights) }}</p>
                </div>
                <div class="bg-mahogany-50 rounded-xl p-5 border border-mahogany-100">
                    <p class="text-xs font-bold text-mahogany-500 uppercase tracking-wider mb-2">Total Penerbangan</p>
                    <p class="font-serif font-bold text-3xl text-mahogany-900">{{ number_format($totalFlights) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Seksi 3: Grafik & Transaksi -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-6">Statistik Pemesanan (6 Bulan Terakhir)</h3>
            <div class="h-64">
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-serif font-bold text-lg text-mahogany-900">Transaksi Terbaru</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-sm font-medium text-mahogany-700 hover:text-mahogany-900 flex items-center gap-1.5">
                    Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="space-y-3">
                @forelse ($recentBookings as $booking)
                    <div class="flex items-center gap-4 p-3 rounded-lg border border-beige-100 hover:border-beige-200 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-mahogany-50 flex items-center justify-center text-mahogany-700 text-xs font-bold">
                            {{ substr($booking->kode_booking, -4) }}
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="text-sm font-medium text-mahogany-900 truncate">{{ $booking->nama_pemesan }}</p>
                            <p class="text-xs text-mahogany-500">{{ $booking->flight->airline->nama_maskapai }} &bull; {{ $booking->flight->origin->kota }} &rarr; {{ $booking->flight->destination->kota }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-mahogany-900">{{ 'Rp ' . number_format($booking->total_harga, 0, ',', '.') }}</p>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-bold @switch($booking->status_pemesanan)
                                @case('Terkonfirmasi') bg-emerald-50 text-emerald-700 @break
                                @case('Lunas') bg-blue-50 text-blue-700 @break
                                @default bg-amber-50 text-amber-700 @endswitch">
                                {{ $booking->status_pemesanan }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-mahogany-500 text-center py-4">Belum ada transaksi terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Seksi 4: Pendapatan & Top Maskapai -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-6">Pendapatan per Bulan (Transaksi Berhasil)</h3>
            <div class="h-48">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-beige-200 p-6 shadow-sm">
            <h3 class="font-serif font-bold text-lg text-mahogany-900 mb-6">Maskapai Terpopuler</h3>
            <div class="space-y-3">
                @forelse ($topAirlines as $airline)
                    <div class="flex items-center gap-3 p-3 rounded-lg border border-beige-100">
                        <span class="text-mahogany-500 text-xs font-bold w-8 text-center">{{ $loop->iteration }}</span>
                        <span class="text-sm font-medium text-mahogany-900 truncate">{{ $airline->nama_maskapai }}</span>
                        <span class="ml-auto text-sm font-bold text-mahogany-900">{{ $airline->jumlah }} pemesanan</span>
                    </div>
                @empty
                    <p class="text-sm text-mahogany-500 text-center py-4">Belum ada data maskapai.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var bookingsCtx = document.getElementById('bookingsChart').getContext('2d');
        var bookingsChart = new Chart(bookingsCtx, {
            type: 'bar',
            data: {
                labels: @json($bookingsPerMonth->pluck('bulan')),
                datasets: [{
                    label: 'Pemesanan',
                    data: @json($bookingsPerMonth->pluck('jumlah')),
                    backgroundColor: 'rgba(138, 72, 80, 0.8)',
                    borderColor: '#8A4850',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } },
                    x: { ticks: { maxRotation: 45, minRotation: 45 } }
                },
                plugins: { legend: { display: false } }
            }
        });

        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($revenuePerMonth->pluck('bulan')),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($revenuePerMonth->pluck('total')),
                    borderColor: '#CBA048',
                    backgroundColor: 'rgba(203, 160, 72, 0.2)',
                    borderWidth: 3,
                    pointBackgroundColor: '#CBA048',
                    pointRadius: 5,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>
@endpush

@endsection
