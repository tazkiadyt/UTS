<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-blue-700 dark:text-blue-300 leading-tight bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">
            {{ __('TiketKu Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Utama -->
            <div class="bg-white dark:bg-blue-900 overflow-hidden shadow-lg sm:rounded-2xl p-6">
                <div class="text-blue-900 dark:text-blue-200 text-2xl font-bold mb-4">
                    Selamat datang di TiketKu Dashboard!
                </div>
                <p class="text-blue-700 dark:text-blue-300 mb-6">
                    Mulai kelola tiket dan pantau aktivitas reservasi dengan mudah
                </p>

                <!-- Tombol Aksi -->
                @can('role-admin')
                    <div class="flex gap-4">
                        <a href="{{ route('tiket.index') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-md">
                            Kelola Tiket
                        </a>
                        <a href="{{ route('reservasi.index') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-md">
                            Lihat Reservasi
                        </a>
                    </div>
                @endcan
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <!-- Card Statistik 1 -->
                <div class="bg-white dark:bg-blue-900 p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 dark:text-blue-300 text-lg font-semibold mb-2">Total Tiket</div>
                    <div class="text-3xl font-bold text-blue-900 dark:text-blue-200">1,250</div>
                </div>

                <!-- Card Statistik 2 -->
                <div class="bg-white dark:bg-blue-900 p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 dark:text-blue-300 text-lg font-semibold mb-2">Reservasi Aktif</div>
                    <div class="text-3xl font-bold text-blue-900 dark:text-blue-200">89</div>
                </div>

                <!-- Card Statistik 3 -->
                <div class="bg-white dark:bg-blue-900 p-6 rounded-lg shadow-lg">
                    <div class="text-blue-600 dark:text-blue-300 text-lg font-semibold mb-2">Pendapatan Hari Iniii</div>
                    <div class="text-3xl font-bold text-blue-900 dark:text-blue-200">Rp 15.5jt</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
