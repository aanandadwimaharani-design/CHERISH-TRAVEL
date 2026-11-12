<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan - CHERISH TRAVEL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #2E1115;
            font-size: 12px;
        }
        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .header {
            border-bottom: 4px solid #CBA048;
            padding-bottom: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #57272D, #2E1115);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #E3C174;
        }
        .company-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 24px;
            font-weight: 700;
            color: #2E1115;
        }
        .company-name span {
            color: #CBA048;
            font-weight: 300;
        }
        .company-sub {
            font-size: 10px;
            color: #8A4850;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 20px;
            font-weight: 700;
            color: #2E1115;
            margin-bottom: 4px;
        }
        .subtitle {
            font-size: 11px;
            color: #6C5B3E;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background: #57272D;
            color: #fff;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px;
            border: 1px solid #D7C7A8;
            text-align: left;
        }
        td {
            padding: 8px;
            border: 1px solid #D7C7A8;
            font-size: 11px;
        }
        tr:nth-child(even) td {
            background: #FAF8F5;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 2px solid #57272D;
        }
        .total {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 18px;
            font-weight: 700;
            color: #2E1115;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: 700;
        }
        .status-Terkonfirmasi { background: #E6FFFA; color: #0C4A6E; }
        .status-Lunas { background: #E0F2FE; color: #0369A1; }
        .status-Dibatalkan { background: #FEF3C7; color: #92400E; }
        .footer {
            margin-top: 32px;
            padding-top: 16px;
            border-top: 1px solid #D7C7A8;
            font-size: 9px;
            color: #6C5B3E;
            text-align: center;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        @page {
            size: A4 landscape;
            margin: 15mm 12mm 15mm 12mm;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
            </svg>
        </div>
        <div>
            <div class="company-name">CHERISH<span style="color:#CBA048;font-weight:300;">TRAVEL</span></div>
            <div class="company-sub">Laporan Pemesanan &amp; Transaksi</div>
        </div>
    </div>

    <div class="title">Laporan Transaksi Pemesanan Tiket</div>
    <div class="subtitle">
        Periode: {{ isset($request->date_from) && $request->date_from ? \Carbon\Carbon::parse($request->date_from)->format('d/m/Y') : '-' }}
        s.d.
        {{ isset($request->date_to) && $request->date_to ? \Carbon\Carbon::parse($request->date_to)->format('d/m/Y') : '-' }}
        {{ isset($request->airline_id) && $request->airline_id ? '| Maskapai: ' : '' }}
        {{ isset($request->airline_id) && $request->airline_id ? \App\Models\Airline::find($request->airline_id)?->nama_maskapai : '' }}
        {{ isset($request->status) && $request->status ? '| Status: ' . $request->status : '' }}
        <br>
        Generated: {{ now()->format('d/m/Y H:i:s') }} WIB
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode Booking</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pemesan</th>
                <th>Maskapai</th>
                <th>Rute</th>
                <th class="text-center">Tgl. Berangkat</th>
                <th class="text-center">Jml. Penumpang</th>
                <th class="text-right">Total (Rp)</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td class="font-mono font-bold">{{ $booking->kode_booking }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $booking->nama_pemesan }}</td>
                    <td>{{ $booking->flight->airline->nama_maskapai }}</td>
                    <td>{{ $booking->flight->origin->kode_bandara }} &rarr; {{ $booking->flight->destination->kode_bandara }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($booking->flight->tanggal_keberangkatan)->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $booking->jumlah_penumpang }}</td>
                    <td class="text-right">{{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center"><span class="status-badge status-{{ $booking->status_pemesanan }}">{{ $booking->status_pemesanan }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <div>
            <div class="text-xs font-bold text-mahogany-600 uppercase">Total Transaksi</div>
            <div class="text-sm font-medium">{{ $bookings->count() }}</div>
        </div>
        <div class="text-right">
            <div class="text-xs font-bold text-mahogany-600 uppercase">Total Pendapatan (Berhasil)</div>
            <div class="total text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} CHERISH TRAVEL. Laporan ini dicetak dari Dashboard Admin CHERISH TRAVEL.
    </div>
</body>
</html>
