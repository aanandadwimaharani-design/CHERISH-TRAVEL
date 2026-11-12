<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard - CHERISH TRAVEL')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
                            700: '#57272D',
                            800: '#431C21',
                            900: '#2E1115',
                            950: '#1D090C'
                        },
                        beige: {
                            50: '#FAF8F5',
                            100: '#F4EFE6',
                            200: '#E8DFC8',
                            300: '#D7C7A8',
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

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

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
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #F4EFE6; }
        ::-webkit-scrollbar-thumb { background: #B87E84; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #6E343B; }
    </style>
    @stack('styles')
</head>
<body class="bg-beige-50 text-mahogany-900 flex flex-col h-screen antialiased selection:bg-mahogany-700 selection:text-white" x-data="{ sidebarOpen: true }">

    <!-- ADMIN SIDEBAR -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'" class="fixed inset-y-0 left-0 z-40 bg-mahogany-900 text-beige-100 transition-all duration-300 flex flex-col shadow-xl border-r border-mahogany-800">
        <div class="flex items-center justify-between h-16 px-4 bg-mahogany-950 border-b border-mahogany-800 shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-mahogany-700 to-mahogany-900 flex items-center justify-center text-gold-400 shadow-md">
                    <svg class="w-5 h-5 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                </div>
                <span class="font-serif font-bold text-xl tracking-wider hidden md:block">
                    CHERISH<span class="text-gold-400 font-light">TRAVEL</span>
                </span>
            </a>
            <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 text-beige-300 hover:text-white">
                <svg x-show="!sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-cloak x-show="sidebarOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="flex-grow px-3 py-4 space-y-1 overflow-y-auto">
            <div class="px-3 mb-6">
                <p class="text-xs font-bold uppercase tracking-wider text-mahogany-400 mb-3">Navigasi</p>
                <ul>
                    <li>
                        <a :class="request()->routeIs('admin.dashboard') ? 'bg-mahogany-800/50 text-gold-400' : 'text-beige-300 hover:text-white'" href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a :class="request()->routeIs('admin.bookings.*') ? 'bg-mahogany-800/50 text-gold-400' : 'text-beige-300 hover:text-white'" href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Pemesanan
                        </a>
                    </li>
                    <li>
                        <a :class="request()->routeIs('admin.flights.*') ? 'bg-mahogany-800/50 text-gold-400' : 'text-beige-300 hover:text-white'" href="{{ route('admin.flights.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Penerbangan
                        </a>
                    </li>
                    <li>
                        <a :class="request()->routeIs('admin.airlines.*') ? 'bg-mahogany-800/50 text-gold-400' : 'text-beige-300 hover:text-white'" href="{{ route('admin.airlines.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 006 0zM6 9a6 6 0 0112 0c0 7-3 9-3 9h-6c-3-2-3-6-3-6m-6 0a6 6 0 0012 0c0 7 3 9 3 9h6c-3-2-3-6-3-6z"/>
                            </svg>
                            Maskapai
                        </a>
                    </li>
                    <li>
                        <a :class="request()->routeIs('admin.airports.*') ? 'bg-mahogany-800/50 text-gold-400' : 'text-beige-300 hover:text-white'" href="{{ route('admin.airports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Bandara
                        </a>
                    </li>
                    <li>
                        <a :class="request()->routeIs('admin.reports.*') ? 'bg-mahogany-800/50 text-gold-400' : 'text-beige-300 hover:text-white'" href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Laporan
                        </a>
                    </li>
                </ul>
            </div>

            <div class="px-3 pb-4 border-t border-mahogany-800 mt-6">
                <p class="text-xs font-bold uppercase tracking-wider text-mahogany-400 mb-3">Akun</p>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-beige-300 hover:text-white hover:bg-mahogany-800/50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </nav>
    </aside>

    <!-- ADMIN HEADER -->
    <header class="pl-[16rem] md:pl-[16rem] fixed top-0 right-0 left-0 z-30 h-16 bg-white/90 backdrop-blur-md border-b border-beige-200 flex items-center justify-between px-6 shrink-0 transition-all duration-300">
        <div class="flex items-center gap-4">
            <h1 class="font-serif font-bold text-xl text-mahogany-900 tracking-wider">
                @yield('page_title', 'Dashboard Admin')
            </h1>
        </div>

        <div class="flex items-center gap-4 ml-auto">
            <div class="flex items-center gap-3 px-4 py-2 bg-beige-100 rounded-full border border-beige-200 text-mahogany-800 text-sm font-medium">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Online
            </div>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-mahogany-700 flex items-center justify-center text-white font-bold text-sm overflow-hidden">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="hidden md:block text-right">
                    <div class="text-sm font-semibold text-mahogany-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-mahogany-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="pl-[16rem] md:pl-[16rem] pt-20 pb-8 flex-grow overflow-y-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
