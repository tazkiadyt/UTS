<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemesanan Tiket Online</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Jika tidak menggunakan Vite, tambahkan CSS Tailwind fallback di sini */
        </style>
    @endif
</head>
<body class="font-sans antialiased bg-blue-50 text-blue-900">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center px-6 py-4 bg-white shadow-sm">
            <h1 class="text-xl font-bold text-blue-700">TiketKu</h1>
            <nav>
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-lg bg-gray-200 text-blue-700 hover:bg-gray-300 transition-colors">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
            <div class="text-center px-6 max-w-md space-y-6">
                <h2 class="text-4xl font-bold text-blue-900">
                    Selamat Datang di TiketKu
                </h2>
                <p class="text-lg text-blue-700">
                    Platform pemesanan tiket online terbaik untuk acara favorit Anda.
                </p>
                <a href="{{ route('login') }}" class="block w-full px-6 py-3 rounded-lg bg-blue-600 text-white text-lg font-medium hover:bg-blue-700 transition-colors shadow-md">
                    Mulai Pesan Tiket
                </a>
            </div>
        </main>

        <!-- Footer -->
        <footer class="text-center py-4 bg-white border-t">
            <p class="text-sm text-blue-600">&copy; {{ date('Y') }} TiketKu. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>