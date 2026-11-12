<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cherish Travel | Menjelajahi Dunia</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
        }

        :root {
            --mahogany: #572F27;
            --beige: #F8EEE3;
            --cream: #FFF9F1;
            --brown: #754B3A;
        }

        /* HEADER */
        header {
            height: 68px;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 5%;
            border-bottom: 1px solid #D9C0AA;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--mahogany);
        }

        .logo-icon {
            font-size: 37px;
        }

        .logo h2 {
            font-family: 'Playfair Display', serif;
            font-size: 25px;
        }

        .logo small {
            font-size: 10px;
            display: block;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: var(--mahogany);
            font-size: 13px;
            font-weight: 600;
            padding: 10px 17px;
            border-radius: 30px;
        }

        nav a.active,
        nav a:hover {
            background: var(--mahogany);
            color: white;
        }

        .login-btn {
            background: var(--mahogany);
            color: white;
            text-decoration: none;
            padding: 10px 19px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
        }

        /* HERO */
        .hero {
            min-height: 550px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 55px 5%;
            background:
                linear-gradient(90deg, rgba(248,238,227,.75), rgba(248,238,227,.25)),
                url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1800&q=85');
            background-size: cover;
            background-position: center;
        }

        .hero-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin: 0 auto;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(65px, 9vw, 125px);
            font-weight: 700;
            line-height: 1;
            color: var(--mahogany);
            margin-bottom: 18px;
            text-align: center;
            width: 100%;
        }

        .hero p {
            font-size: 16px;
            margin-bottom: 25px;
            text-align: center;
        }

        .main-btn {
            display: inline-block;
            background: var(--mahogany);
            color: white;
            padding: 13px 25px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
        }

        /* SEARCH */
        .search-wrapper {
            max-width: 1380px;
            margin: -45px auto 30px;
            padding: 0 30px;
            position: relative;
            z-index: 3;
        }

        .tabs {
            display: flex;
            gap: 3px;
        }

        .tab {
            background: #FFF9F1;
            padding: 13px 25px;
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            font-size: 14px;
        }

        .tab.active {
            background: var(--mahogany);
            color: white;
        }

        .search-box {
            background: var(--cream);
            padding: 23px 30px;
            border-radius: 0 16px 16px 16px;
            box-shadow: 0 8px 22px rgba(87,47,39,.13);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr auto;
            gap: 20px;
            align-items: end;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .field input,
        .field select {
            width: 100%;
            padding: 13px;
            border: 1px solid #E6D4C2;
            background: #FCF6EF;
            border-radius: 10px;
            font-family: inherit;
            color: var(--mahogany);
        }

        .search-btn {
            background: var(--mahogany);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 15px 25px;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
        }

        /* FEATURES */
        .features {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            max-width: 1200px;
            margin: 35px auto;
            gap: 20px;
            padding: 0 20px;
        }

        .feature {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            border-right: 1px solid #BFA18B;
            padding: 8px;
        }

        .feature:last-child {
            border: none;
        }

        .feature-icon {
            font-size: 32px;
        }

        .feature strong {
            font-size: 14px;
        }

        .feature p {
            font-size: 13px;
        }

        /* DESTINATIONS */
        .destinations {
            padding: 15px 7% 55px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 25px;
            margin-bottom: 20px;
        }

        .section-heading h2 {
            font-family: 'Playfair Display', serif;
            font-size: 35px;
            white-space: nowrap;
        }

        .line {
            height: 1px;
            background: #BFA18B;
            flex: 1;
        }

        .see-all {
            color: var(--mahogany);
            border: 1px solid var(--mahogany);
            padding: 9px 16px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        .destination-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .destination-card {
            height: 175px;
            border-radius: 13px;
            overflow: hidden;
            position: relative;
        }

        .destination-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .3s;
        }

        .destination-card:hover img {
            transform: scale(1.07);
        }

        .destination-name {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background: rgba(87,47,39,.88);
            color: white;
            padding: 8px 14px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 600;
        }

        footer {
            background: var(--mahogany);
            color: white;
            text-align: center;
            padding: 22px;
            font-size: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            header {
                height: auto;
                padding: 18px;
                flex-wrap: wrap;
                gap: 15px;
            }

            nav {
                order: 3;
                width: 100%;
                flex-wrap: wrap;
                gap: 5px;
            }

            .hero h1 {
                font-size: clamp(50px, 9vw, 85px);
            }

            .search-box {
                grid-template-columns: repeat(2, 1fr);
            }

            .features,
            .destination-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 550px) {
            .hero {
                min-height: 380px;
                padding: 35px 7%;
            }

            .hero h1 {
                font-size: clamp(38px, 10vw, 55px);
            }

            .hero p {
                font-size: 13px;
            }

            .search-box {
                grid-template-columns: 1fr;
            }

            .features {
                grid-template-columns: 1fr 1fr;
            }

            .feature {
                border: none;
            }

            .destination-grid {
                grid-template-columns: 1fr 1fr;
            }

            .section-heading h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="logo">
        <div class="logo-icon">✈️</div>
        <div>
            <h2>Cherish Travel</h2>
            <small>Your Journey, Our Priority</small>
        </div>
    </div>

    <nav>
        <a href="/" class="active">Beranda</a>
        <a href="#pencarian">Penerbangan ⌄</a>
        <a href="#destinasi">Tentang Kami</a>
        <a href="#bantuan">Bantuan ⌄</a>
    </nav>

    <a href="/login" class="login-btn">♟ Login Admin</a>
</header>

<section class="hero">
    <div class="hero-content">
        <h1>CHERISH TRAVEL.</h1>
        <p>Perjalanan impian Anda, kini lebih mudah dan nyaman bersama kami.</p>
        <a href="#pencarian" class="main-btn">Pesan Sekarang →</a>
    </div>
</section>

<section class="search-wrapper" id="pencarian">

    <div class="tabs">
        <div class="tab active">✈️ Pesawat</div>
        <div class="tab">▣ Hotel</div>
        <div class="tab">▤ Kereta Api</div>
    </div>

   <form action="{{ route('penerbangan.search') }}" method="GET">

       <div>
    <label>Bandara Asal</label>
    <select name="asal" required>
        <option value="">Pilih Bandara Asal</option>
        @foreach ($bandara as $b)
            <option value="{{ $b->id }}">
                {{ $b->kota }} - {{ $b->nama }} ({{ $b->kode }})
            </option>
        @endforeach
    </select>
</div>

<div>
    <label>Bandara Tujuan</label>
    <select name="tujuan" required>
        <option value="">Pilih Bandara Tujuan</option>
        @foreach ($bandara as $b)
            <option value="{{ $b->id }}">
                {{ $b->kota }} - {{ $b->nama }} ({{ $b->kode }})
            </option>
        @endforeach
    </select>
</div>

        <div class="field">
            <label>Tanggal Berangkat</label>
            <input type="date" name="tanggal" required>
            <input type="number name="penumpang"
            min="1" value="1" required>
        </div>

        <div class="field">
            <label>Penumpang</label>
            <select name="penumpang">
                <option value="1">1 Penumpang</option>
                <option value="2">2 Penumpang</option>
                <option value="3">3 Penumpang</option>
                <option value="4">4 Penumpang</option>
                <option value="5">5 Penumpang</option>
            </select>
        </div>

        <button type="submit" class="search-btn">⌕ Cari Tiket</button>

    </form>
</section>

<section class="features">

    <div class="feature">
        <div class="feature-icon">🛡️</div>
        <div>
            <strong>Transaksi Aman</strong>
            <p>dan Terpercaya</p>
        </div>
    </div>

    <div class="feature">
        <div class="feature-icon">🎧</div>
        <div>
            <strong>Layanan 24/7</strong>
            <p>Siap Membantu</p>
        </div>
    </div>

    <div class="feature">
        <div class="feature-icon">％</div>
        <div>
            <strong>Harga Terbaik</strong>
            <p>Setiap Saat</p>
        </div>
    </div>

    <div class="feature">
        <div class="feature-icon">🌐</div>
        <div>
            <strong>Jangkauan Global</strong>
            <p>ke Seluruh Dunia</p>
        </div>
    </div>

</section>

<section class="destinations" id="destinasi">

    <div class="section-heading">
        <h2>Destinasi Populer</h2>
        <div class="line"></div>
        <a href="#destinasi" class="see-all">Lihat Semua →</a>
    </div>

    <div class="destination-grid">

        <div class="destination-card">
            <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=700&q=85" alt="Paris">
            <div class="destination-name">📍 Paris, Prancis</div>
        </div>

        <div class="destination-card">
            <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=700&q=85" alt="Tokyo">
            <div class="destination-name">📍 Tokyo, Jepang</div>
        </div>

        <div class="destination-card">
            <img src="https://images.unsplash.com/photo-1525625293386-3f8f99389edd?auto=format&fit=crop&w=700&q=85" alt="Singapura">
            <div class="destination-name">📍 Singapura</div>
        </div>

        <div class="destination-card">
            <img src="https://images.unsplash.com/photo-1565552645632-d725f8bfc19a?auto=format&fit=crop&w=700&q=85" alt="Mekkah">
            <div class="destination-name">📍 Mekkah, Arab Saudi</div>
        </div>

    </div>
</section>

<footer id="bantuan">
    © 2026 Cherish Travel. All Rights Reserved.
</footer>

</body>
</html>