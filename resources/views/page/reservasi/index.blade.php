<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-600 bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text">
            {{ __('Reservasi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Form Add Reservasi -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Input Data Reservasi</h3>
                    <form action="{{ route('reservasi.store') }}" method="post">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="user_id" class="block mb-2 text-sm font-medium text-blue-700">User</label>
                                <select name="user_id" id="user_id" class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="">Pilih User...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tiket_id" class="block mb-2 text-sm font-medium text-blue-700">Tiket</label>
                                <select name="tiket_id" id="tiket_id" class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg block w-full p-2.5">
                                    <option value="">Pilih Tiket...</option>
                                    @foreach ($tikets as $tiket)
                                        <option value="{{ $tiket->id }}" data-harga="{{ $tiket->harga }}">
                                            {{ $tiket->nama_event }} - {{ number_format($tiket->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="kode_reservasi" class="block mb-2 text-sm font-medium text-blue-700">Kode Reservasi</label>
                                <input name="kode_reservasi" type="text" id="kode_reservasi" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="jumlah" class="block mb-2 text-sm font-medium text-blue-700">Jumlah</label>
                                <input name="jumlah" type="number" id="jumlah" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="total_harga" class="block mb-2 text-sm font-medium text-blue-700">Total Harga</label>
                                <input name="total_harga" type="text" id="total_harga" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg block w-full p-2.5" readonly />
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                SIMPAN
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Table Data Reservasi -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Daftar Reservasi</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-blue-800">
                            <thead class="text-xs uppercase bg-blue-100 text-blue-700">
                                <tr>
                                    <th class="px-6 py-3">NO</th>
                                    <th class="px-6 py-3">USER</th>
                                    <th class="px-6 py-3">TIKET</th>
                                    <th class="px-6 py-3">KODE RESERVASI</th>
                                    <th class="px-6 py-3">JUMLAH</th>
                                    <th class="px-6 py-3">TOTAL HARGA</th>
                                    <th class="px-6 py-3">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($reservasis as $reservasi)
                                    <tr class="bg-white border-b hover:bg-blue-50">
                                        <td class="px-6 py-4">{{ $no++ }}</td>
                                        <td class="px-6 py-4">{{ $reservasi->user->name }}</td>
                                        <td class="px-6 py-4">{{ $reservasi->tiket->nama_event }}</td>
                                        <td class="px-6 py-4">{{ $reservasi->kode_reservasi }}</td>
                                        <td class="px-6 py-4">{{ $reservasi->jumlah }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <button type="button"
                                                data-id="{{ $reservasi->id }}"
                                                data-user_id="{{ $reservasi->user_id }}"
                                                data-tiket_id="{{ $reservasi->tiket_id }}"
                                                data-kode_reservasi="{{ $reservasi->kode_reservasi }}"
                                                data-jumlah="{{ $reservasi->jumlah }}"
                                                data-total_harga="{{ $reservasi->total_harga }}"
                                                onclick="editReservasiModal(this)"
                                                class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                Edit
                                            </button>
                                            <form action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')"
                                                    class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-xs text-white">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $reservasis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Reservasi -->
    <div id="reservasiModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 relative">
            <div class="flex items-start justify-between pb-4 border-b">
                <h3 class="text-xl font-bold text-blue-600" id="modalTitle">Edit Reservasi</h3>
                <button type="button" onclick="closeReservasiModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <form id="reservasiForm" action="" method="POST" class="space-y-4 pt-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="user_id_edit" class="block text-sm font-medium text-blue-700">User</label>
                    <select name="user_id" id="user_id_edit" class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-md block w-full p-2">
                        <option value="">Pilih User...</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tiket_id_edit" class="block text-sm font-medium text-blue-700">Tiket</label>
                    <select name="tiket_id" id="tiket_id_edit" class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-md block w-full p-2">
                        <option value="">Pilih Tiket...</option>
                        @foreach ($tikets as $tiket)
                            <option value="{{ $tiket->id }}" data-harga="{{ $tiket->harga }}">
                                {{ $tiket->nama_event }} - {{ number_format($tiket->harga, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="kode_reservasi_edit" class="block text-sm font-medium text-blue-700">Kode Reservasi</label>
                    <input type="text" id="kode_reservasi_edit" name="kode_reservasi" class="w-full border border-blue-300 rounded-md p-2" />
                </div>
                <div>
                    <label for="jumlah_edit" class="block text-sm font-medium text-blue-700">Jumlah</label>
                    <input type="number" id="jumlah_edit" name="jumlah" class="w-full border border-blue-300 rounded-md p-2" />
                </div>
                <div>
                    <label for="total_harga_edit" class="block text-sm font-medium text-blue-700">Total Harga</label>
                    <input type="text" id="total_harga_edit" name="total_harga" class="w-full border border-blue-300 rounded-md p-2" readonly />
                </div>
                <div class="flex items-center justify-end pt-4 border-t">
                    <button type="button" onclick="closeReservasiModal()" class="mr-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Perhitungan Total Harga & Modal -->
    <script>
        // Perhitungan total harga untuk form create
        document.addEventListener("DOMContentLoaded", function () {
            let tiketSelect = document.getElementById("tiket_id");
            let jumlahInput = document.getElementById("jumlah");
            let totalHargaInput = document.getElementById("total_harga");

            function hitungTotal() {
                let selectedOption = tiketSelect.options[tiketSelect.selectedIndex];
                let harga = parseFloat(selectedOption.getAttribute("data-harga")) || 0;
                let jumlah = parseInt(jumlahInput.value) || 0;
                totalHargaInput.value = harga * jumlah;
            }

            tiketSelect.addEventListener("change", hitungTotal);
            jumlahInput.addEventListener("input", hitungTotal);
        });

        // Perhitungan total harga untuk form edit di modal
        document.addEventListener("DOMContentLoaded", function () {
            let tiketSelectEdit = document.getElementById("tiket_id_edit");
            let jumlahInputEdit = document.getElementById("jumlah_edit");
            let totalHargaInputEdit = document.getElementById("total_harga_edit");

            function hitungTotalEdit() {
                let selectedOption = tiketSelectEdit.options[tiketSelectEdit.selectedIndex];
                let harga = parseFloat(selectedOption.getAttribute("data-harga")) || 0;
                let jumlah = parseInt(jumlahInputEdit.value) || 0;
                totalHargaInputEdit.value = harga * jumlah;
            }

            tiketSelectEdit.addEventListener("change", hitungTotalEdit);
            jumlahInputEdit.addEventListener("input", hitungTotalEdit);
        });

        // Fungsi membuka modal edit reservasi dan mengisi form dengan data yang ada
        function editReservasiModal(button) {
            const id = button.getAttribute('data-id');
            const user_id = button.getAttribute('data-user_id');
            const tiket_id = button.getAttribute('data-tiket_id');
            const kode_reservasi = button.getAttribute('data-kode_reservasi');
            const jumlah = button.getAttribute('data-jumlah');
            const total_harga = button.getAttribute('data-total_harga');

            document.getElementById('user_id_edit').value = user_id;
            document.getElementById('tiket_id_edit').value = tiket_id;
            document.getElementById('kode_reservasi_edit').value = kode_reservasi;
            document.getElementById('jumlah_edit').value = jumlah;
            document.getElementById('total_harga_edit').value = total_harga;

            // Atur action form untuk update, misalnya /reservasi/{id}
            document.getElementById('reservasiForm').action = `/reservasi/${id}`;

            document.getElementById('reservasiModal').classList.remove('hidden');
        }

        // Fungsi menutup modal edit reservasi
        function closeReservasiModal() {
            document.getElementById('reservasiModal').classList.add('hidden');
            document.getElementById('reservasiForm').reset();
        }
    </script>
</x-app-layout>
