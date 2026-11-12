<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - CHERISH TRAVEL</title>

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

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF8F5;
            color: #2E1115;
        }
        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
        }
    </style>
</head>
<body class="bg-beige-50 text-mahogany-900 flex items-center justify-center min-h-screen px-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl border border-beige-200 overflow-hidden">
        <div class="bg-gradient-to-br from-mahogany-700 to-mahogany-900 p-8 text-white">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-gold-400 backdrop-blur-sm">
                    <svg class="w-6 h-6 transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-serif font-bold text-2xl text-white tracking-wider">CHERISH<span class="text-gold-400 font-light">TRAVEL</span></h1>
                    <p class="text-xs text-beige-300 uppercase tracking-widest font-semibold">Admin Dashboard</p>
                </div>
            </div>

            <p class="text-beige-200 text-sm max-w-md">
                Masuk dengan kredensial admin Anda untuk mengakses dashboard manajemen pemesanan tiket pesawat.
            </p>
        </div>

        <div class="p-8">
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-start gap-3 text-sm">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-amber-50 border border-amber-200 text-amber-900 rounded-xl flex items-start gap-3 text-sm">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold mb-1">Harap periksa kembali:</h4>
                        <ul class="list-disc list-inside text-xs">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Username atau Email</label>
                    <input type="text" name="login" value="{{ old('login') }}" required placeholder="Masukkan username atau email" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <label class="block text-xs font-bold text-mahogany-800 uppercase tracking-wider mb-2">Password</label>
                        <input type="password" name="password" required placeholder="Masukkan password" class="w-full px-4 py-3 bg-beige-50 border border-beige-300 rounded-xl focus:ring-2 focus:ring-mahogany-700 focus:outline-none text-mahogany-900">
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-mahogany-700 rounded border-beige-300 focus:ring-mahogany-700">
                    <label for="remember" class="text-xs text-mahogany-600">Ingat saya</label>
                </div>

                <button type="submit" class="w-full py-4 bg-mahogany-700 hover:bg-mahogany-800 text-white font-bold rounded-xl text-sm tracking-wide transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9l3 3m0 0l3-3m-3 3v6m0 0V9m0 0h6m0 0H3"/>
                    </svg>
                    Masuk
                </button>
            </form>

            <p class="mt-6 text-center text-xs text-mahogany-500">
                &copy; {{ date('Y') }} CHERISH TRAVEL. Halaman Khusus Admin.
            </p>
        </div>
    </div>

</body>
</html>
