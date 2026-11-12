<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Cherish Travel</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8EEE3;
            color: #572F27;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .container {
            max-width: 1050px;
            width: 100%;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 45px;
        }

        .brand {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #87675C;
            font-size: 14px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 29px;
            text-align: center;
            margin-bottom: 10px;
        }

        .section-description {
            text-align: center;
            color: #87675C;
            font-size: 13px;
            margin-bottom: 35px;
        }

        .flight {
            background: #FFFFFF;
            padding: 32px;
            margin-bottom: 25px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(87, 47, 39, 0.08);
            border: 1px solid #E9DDC9;
        }

        .flight-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .airline {
            font-weight: 600;
            font-size: 17px;
        }

        .flight-number {
            font-size: 12px;
            color: #987B70;
            margin-top: 5px;
        }

        .badge {
            background: #F2E8DB;
            color: #572F27;
            padding: 8px 15px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .route {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 20px;
            padding: 25px 0;
            border-top: 1px solid #EEE5DA;
            border-bottom: 1px solid #EEE5DA;
        }

        .airport:last-child {
            text-align: right;
        }

        .airport h3 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .airport p {
            color: #987B70;
            font-size: 12px;
        }

        .plane {
            font-size: 25px;
            text-align: center;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .detail-label {
            font-size: 11px;
            color: #987B70;
            margin-bottom: 7px;
        }

        .detail-value {
            font-size: 13px;
            font-weight: 600;
        }

        .flight-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #EEE5DA;
        }

        .price-label {
            font-size: 12px;
            color: #987B70;
        }

        .price {
            font-size: 25px;
            font-weight: 700;
            margin-top: 5px;
        }

        .select-button {
            display: inline-block;
            background: #572F27;
            color: white;
            padding: 13px 27px;
            border-radius: 8px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .select-button:hover {
            background: #70483D;
            transform: translateY(-2px);
        }

        .empty {
            background: white;
            padding: 55px 25px;
            text-align: center;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(87, 47, 39, 0.06);
        }

        .empty h3 {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
            margin-bottom: 12px;
        }

        .empty p {
            color: #987B70;
            font-size: 13px;
        }

        .back {
            display: block;
            width: fit-content;
            margin: 35px auto 0;
            color: #572F27;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .back:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            body {
                padding: 30px 15px;
            }

            .brand {
                font-size: 30px;
            }

            .section-title {
                font-size: 24px;
            }

            .flight {
                padding: 22px 18px;
            }

            .route {
                gap: 10px;
            }

            .airport h3 {
                font-size: 20px;
            }

            .details {
                grid-template-columns: 1fr 1fr;
                gap: 20px 10px;
            }

            .price {
                font-size: 21px;
            }

            .select-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">
        <h1 class="brand">CHERISH TRAVEL</h1>
        <p class="subtitle">Your Journey, Our Priority.</p>
    </header>

    <h2 class="section-title">Hasil Pencarian Penerbangan</h2>
    <p class="section-description">
        Temukan penerbangan terbaik untuk perjalanan Anda.
    </p>

    @forelse ($penerbangan as $p)

        <div class="flight">

            <div class="flight-top">
                <div>
                    <div class="airline">{{ $p->maskapai }}</div>
                    <div class="flight-number">
                        Nomor Penerbangan: {{ $p->nomor_penerbangan }}
                    </div>
                </div>

                <span class="badge">Penerbangan Tersedia</span>
            </div>

            <div class="route">

                <div class="airport">
                    <h3>{{ $p->bandaraAsal->kota }}</h3>
                    <p>{{ $p->bandaraAsal->nama }}</p>
                    <p>{{ $p->berangkat_pada }}</p>
                </div>

                <div class="plane">✈️</div>

                <div class="airport">
                    <h3>{{ $p->bandaraTujuan->kota }}</h3>
                    <p>{{ $p->bandaraTujuan->nama }}</p>
                    <p>{{ $p->tiba_pada }}</p>
                </div>

            </div>

            <div class="details">

                <div>
                    <p class="detail-label">Maskapai</p>
                    <p class="detail-value">{{ $p->maskapai }}</p>
                </div>

                <div>
                    <p class="detail-label">Nomor Penerbangan</p>
                    <p class="detail-value">{{ $p->nomor_penerbangan }}</p>
                </div>

                <div>
                    <p class="detail-label">Kursi Tersedia</p>
                    <p class="detail-value">{{ $p->kursi_tersedia }} Kursi</p>
                </div>

            </div>

            <div class="flight-bottom">

                <div>
                    <p class="price-label">Harga per penumpang</p>
                    <p class="price">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </p>
                </div>

                <button type="button" class="select-button">
                    Pilih Tiket
                </button>

            </div>

        </div>

    @empty

        <div class="empty">
            <h3>Penerbangan Tidak Ditemukan</h3>
            <p>
                Maaf, belum ada penerbangan untuk rute dan tanggal tersebut.
                Silakan coba pencarian lainnya.
            </p>
        </div>

    @endforelse

    <a href="{{ route('home') }}" class="back">
        ← Kembali ke Beranda
    </a>

</div>

</body>
</html>