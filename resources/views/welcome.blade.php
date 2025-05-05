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
        <main class="relative flex-grow bg-cover bg-center bg-no-repeat flex items-center justify-center text-white" 
        style="background-image: url('https://cdn.antaranews.com/cache/1200x800/2021/12/28/pexels-thibault-trillet-167636-1.jpg.webp'); min-height: 80vh;">
  
      <!-- Overlay -->
      <div class="absolute inset-0 bg-blue-900/60"></div>
  
      <!-- Konten -->
      <div class="relative z-10 text-center max-w-xl px-6 space-y-6">
          <h2 class="text-4xl font-bold leading-tight">
              Selamat Datang di TiketKu
          </h2>
          <p class="text-lg">
              Platform pemesanan tiket online terbaik untuk acara favorit Anda.
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
              <a href="{{ route('login') }}" class="px-6 py-3 rounded-lg bg-blue-600 text-white text-lg font-medium hover:bg-blue-700 transition-colors shadow-md text-center">
                  Mulai Pesan Tiket
              </a>
              <a href="{{ route('register') }}" class="px-6 py-3 rounded-lg bg-white text-blue-700 text-lg font-medium hover:bg-blue-100 transition-colors shadow-md text-center border border-blue-200">
                  Daftar Sekarang
              </a>
          </div>
      </div>
  </main>
  
  
        <!-- Footer -->
        <footer class="text-center py-4 bg-white border-t">
            <p class="text-sm text-blue-600">&copy; {{ date('Y') }} TiketKu. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>