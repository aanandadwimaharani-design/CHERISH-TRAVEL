<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'CHERISH TRAVEL - Pemesanan Tiket Pesawat Elegan & Terpercaya')</title>

    <!-- Google Fonts: Playfair Display (Serif) & Plus Jakarta Sans (Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN dengan Custom Palette Mahogany & Beige -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mahogany: {
                            50: '#FBF7F7',
                            100: '#F5ECEC',
                            200: '#EBD8D9',
                            300: '#DAB8BB',
                            400: '#B87E84',
                            500: '#8A4850',
                            600: '#6E343B',
                            700: '#57272D', // Mahogany utama
                            800: '#431C21', // Dark Mahogany
                            900: '#2E1115', // Deep Mahogany
                            950: '#1D090C'
                        },
                        beige: {
                            50: '#FAF8F5',  // Background utama lembut
                            100: '#F4EFE6', // Card background / section
                            200: '#E8DFC8', // Border halus
                            300: '#D7C7A8', // Border kontras
                            400: '#C4B08C',
                            500: '#A9926A',
                            600: '#8C7752',
                            700: '#6C5B3E',
                            800: '#4E422E',
                            900: '#332B1E'
                        },
                        gold: {
                            400: '#E3C174',
                            500: '#CBA048',
                            600: '#A87D2E'
                        }
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF8F5;
            color: #2E1115;
        }

        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F4EFE6;
        }
        ::-webkit-scrollbar-thumb {
            background: #B87E84;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #6E343B;
        }

        /* Print styles */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                color: black !important;
            }
            .print-ticket {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-beige-50 text-mahogany-900 flex flex-col min-h-screen antialiased selection:bg-mahogany-700 selection:text-white" x-data="{ mobileMenu: false, cekTiketModal: false }">

    <!-- NAVBAR ELEGAN -->
    <header class="no-print sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-beige-200 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- BRAND LOGO -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-mahogany-700 to-mahogany-900 flex items-center justify-center text-gold-400 shadow-md group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                        <svg class="w-6 h-6 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block font-serif text-2xl font-bold tracking-wider text-mahogany-900 leading-none">
                            CHERISH<span class="text-gold-500 font-light">TRAVEL</span>
                        </span>
                        <span class="block text-[10px] uppercase tracking-[0.25em] text-mahogany-500 font-semibold mt-1">
                            Premium Flight Booking
                        </span>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-sm font-semibold tracking-wide {{ request()->routeIs('home') ? 'text-mahogany-700 border-b-2 border-mahogany-700 pb-1' : 'text-mahogany-700/70 hover:text-mahogany-800' }} transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('flights.index') }}" class="text-sm font-semibold tracking-wide {{ request()->routeIs('flights.*') ? 'text-mahogany-700 border-b-2 border-mahogany-700 pb-1' : 'text-mahogany-700/70 hover:text-mahogany-800' }} transition-colors">
                        Penerbangan
                    </a>
                    <a href="{{ route('home') }}#tentang-kami" class="text-sm font-semibold tracking-wide text-mahogany-700/70 hover:text-mahogany-800 transition-colors">
                        Tentang Kami
                    </a>
                    <a href="{{ route('home') }}#kontak" class="text-sm font-semibold tracking-wide text-mahogany-700/70 hover:text-mahogany-800 transition-colors">
                        Kontak
                    </a>
                </nav>

                <!-- CTA BUTTONS -->
                <div class="hidden md:flex items-center gap-3">
                    <button @click="cekTiketModal = true" class="px-4 py-2.5 rounded-lg text-xs font-bold tracking-wider uppercase border border-mahogany-700/30 text-mahogany-800 hover:bg-beige-100 transition-all flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-mahogany-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Cek E-Ticket
                    </button>
                    <a href="{{ route('flights.index') }}" class="px-5 py-2.5 rounded-lg text-xs font-bold tracking-wider uppercase bg-gradient-to-r from-mahogany-700 to-mahogany-800 hover:from-mahogany-800 hover:to-mahogany-900 text-white shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <span>Cari Tiket</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <!-- MOBILE HAMBURGER BUTTON -->
                <div class="flex md:hidden items-center">
                    <button @click="mobileMenu = !mobileMenu" type="button" class="p-2 rounded-lg text-mahogany-800 hover:bg-beige-100 transition-colors">
                        <svg x-show="!mobileMenu" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-cloak x-show="mobileMenu" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU DROPDOWN -->
        <div x-cloak x-show="mobileMenu" x-transition class="md:hidden bg-white border-b border-beige-200 px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-mahogany-900 hover:bg-beige-100">
                Beranda
            </a>
            <a href="{{ route('flights.index') }}" class="block px-3 py-2 rounded-md text-base font-semibold text-mahogany-900 hover:bg-beige-100">
                Penerbangan
            </a>
            <a href="{{ route('home') }}#tentang-kami" @click="mobileMenu = false" class="block px-3 py-2 rounded-md text-base font-semibold text-mahogany-900 hover:bg-beige-100">
                Tentang Kami
            </a>
            <a href="{{ route('home') }}#kontak" @click="mobileMenu = false" class="block px-3 py-2 rounded-md text-base font-semibold text-mahogany-900 hover:bg-beige-100">
                Kontak
            </a>
            <div class="pt-3 border-t border-beige-200 flex flex-col gap-2">
                <button @click="cekTiketModal = true; mobileMenu = false" class="w-full text-center py-2.5 px-4 rounded-lg font-bold text-sm border border-mahogany-700/30 text-mahogany-800 hover:bg-beige-100">
                    Cek E-Ticket
                </button>
                <a href="{{ route('flights.index') }}" class="w-full text-center py-2.5 px-4 rounded-lg font-bold text-sm bg-mahogany-700 text-white hover:bg-mahogany-800">
                    Cari Tiket Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    <div class="no-print max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-500 hover:text-red-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div x-data="{ show: true }" x-show="show" class="mb-4 bg-amber-50 border border-amber-200 text-amber-900 px-4 py-3 rounded-xl shadow-sm">
                <div class="flex items-start justify-between">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-amber-900 mb-1">Harap periksa kembali isian formulir Anda:</h4>
                            <ul class="text-xs space-y-1 list-disc list-inside text-amber-800">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button @click="show = false" class="text-amber-500 hover:text-amber-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER ELEGAN -->
    <footer class="no-print bg-mahogany-950 text-beige-100 border-t-4 border-gold-500 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <!-- IDENTITAS PERUSAHAAN -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-mahogany-800 border border-gold-500/30 flex items-center justify-center text-gold-400">
                            <svg class="w-5 h-5 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                            </svg>
                        </div>
                        <span class="font-serif text-2xl font-bold tracking-wider text-white">
                            CHERISH<span class="text-gold-400">TRAVEL</span>
                        </span>
                    </div>
                    <p class="text-sm text-beige-300 leading-relaxed">
                        Platform pemesanan tiket pesawat modern yang mengedepankan kemudahan, keamanan, kenyamanan, serta kemewahan perjalanan Anda ke seluruh penjuru Nusantara dan Dunia.
                    </p>
                    <div class="flex items-center gap-3 text-gold-400 pt-2">
                        <span class="w-8 h-8 rounded-full bg-mahogany-900 border border-mahogany-800 flex items-center justify-center text-xs font-bold">100%</span>
                        <span class="text-xs font-medium text-beige-200">Mitra Resmi Maskapai Terpercaya</span>
                    </div>
                </div>

                <!-- TAUTAN CEPAT -->
                <div>
                    <h4 class="font-serif text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                        Navigasi Cepat
                    </h4>
                    <ul class="space-y-2.5 text-sm text-beige-300">
                        <li><a href="{{ route('home') }}" class="hover:text-gold-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('flights.index') }}" class="hover:text-gold-400 transition-colors">Pencarian Tiket Pesawat</a></li>
                        <li><a href="{{ route('home') }}#rekomendasi" class="hover:text-gold-400 transition-colors">Destinasi Populer</a></li>
                        <li><a href="{{ route('home') }}#promo" class="hover:text-gold-400 transition-colors">Penawaran & Promo Spesial</a></li>
                        <li><a href="{{ route('home') }}#tentang-kami" class="hover:text-gold-400 transition-colors">Tentang Cherish Travel</a></li>
                        <li><a href="{{ route('home') }}#kontak" class="hover:text-gold-400 transition-colors">Bantuan & Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- DESTINASI FAVORIT -->
                <div>
                    <h4 class="font-serif text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                        Destinasi Pilihan
                    </h4>
                    <ul class="space-y-2.5 text-sm text-beige-300">
                        <li><a href="{{ route('flights.index', ['destination_id' => 2]) }}" class="hover:text-gold-400 transition-colors">Penerbangan ke Bali (DPS)</a></li>
                        <li><a href="{{ route('flights.index', ['destination_id' => 7]) }}" class="hover:text-gold-400 transition-colors">Penerbangan ke Labuan Bajo (LBJ)</a></li>
                        <li><a href="{{ route('flights.index', ['destination_id' => 4]) }}" class="hover:text-gold-400 transition-colors">Penerbangan ke Yogyakarta (YIA)</a></li>
                        <li><a href="{{ route('flights.index', ['destination_id' => 13]) }}" class="hover:text-gold-400 transition-colors">Penerbangan ke Singapura (SIN)</a></li>
                        <li><a href="{{ route('flights.index', ['destination_id' => 15]) }}" class="hover:text-gold-400 transition-colors">Penerbangan ke Tokyo (HND)</a></li>
                        <li><a href="{{ route('flights.index', ['destination_id' => 19]) }}" class="hover:text-gold-400 transition-colors">Penerbangan ke Jeddah / Mekkah (JED)</a></li>
                    </ul>
                </div>

                <!-- KONTAK & ALAMAT -->
                <div>
                    <h4 class="font-serif text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                        Hubungi Kami
                    </h4>
                    <div class="space-y-3 text-sm text-beige-300">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-gold-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Cherish Tower Lt. 18, Jl. Sudirman No. 88, Jakarta Selatan 12190</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gold-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+62 (21) 8899-7722 / 24 Jam</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-gold-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>support@cherishtravel.com</span>
                        </div>
                        <div class="pt-3">
                            <span class="inline-block px-3 py-1 bg-mahogany-900 border border-mahogany-800 rounded-full text-xs font-semibold text-emerald-400">
                                ● Layanan Pelanggan Siaga 24/7
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- COPYRIGHT & SIGNATURE -->
            <div class="border-t border-mahogany-900 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-beige-400 gap-4">
                <p>&copy; {{ date('Y') }} <strong class="text-gold-400 font-semibold">CHERISH TRAVEL</strong>. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center space-x-6">
                    <span class="hover:text-gold-400 cursor-pointer">Syarat & Ketentuan</span>
                    <span class="hover:text-gold-400 cursor-pointer">Kebijakan Privasi</span>
                    <span class="hover:text-gold-400 cursor-pointer">Keamanan Pembayaran</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODAL CEK E-TICKET CEPAT -->
    <div x-cloak x-show="cekTiketModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="cekTiketModal" x-transition.opacity class="fixed inset-0 bg-mahogany-950/70 backdrop-blur-sm transition-opacity" @click="cekTiketModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="cekTiketModal" x-transition class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-beige-200">
                <div class="bg-gradient-to-r from-mahogany-800 to-mahogany-900 px-6 py-5 text-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-gold-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-serif text-lg font-bold">Cek E-Ticket Anda</h3>
                            <p class="text-xs text-beige-200">Masukkan kode booking tiket pesawat</p>
                        </div>
                    </div>
                    <button @click="cekTiketModal = false" class="text-white/70 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="p-6 bg-beige-50">
                    <form onsubmit="event.preventDefault(); const code = document.getElementById('inputKodeBookingModal').value.trim(); if(code) { window.location.href = '/tiket/' + encodeURIComponent(code); }">
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Kode Booking (Contoh: CT-XXXXXX)</label>
                            <input type="text" id="inputKodeBookingModal" required placeholder="CT-XXXXXX" class="w-full px-4 py-3 bg-white border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none uppercase font-mono text-center tracking-widest text-lg font-bold text-mahogany-900">
                        </div>
                        <button type="submit" class="w-full py-3 bg-mahogany-700 hover:bg-mahogany-800 text-white font-bold rounded-xl transition-all shadow-md">
                            Buka E-Ticket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
