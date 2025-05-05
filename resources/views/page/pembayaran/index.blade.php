<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
                {{ __('Pembayaran') }}
            </h2>
            <button onclick="openModal()" class="px-4 py-2 bg-sky-600 text-white rounded-xl hover:bg-sky-500">
                Add
            </button>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Table Section -->
            <div class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700">
                <div class="mb-5 text-lg font-medium text-gray-900 dark:text-white">Data Pembayaran</div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                    No
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Kode Reservasi
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Metode Pembayaran
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Jumlah Pembayaran
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Waktu Pembayaran
                                </th>
                                <th class="relative px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @php $no = 1; @endphp
                            @foreach ($pembayaran as $a)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-700">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $no++ }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $a->reservasi->kode_reservasi }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $a->metode_pembayaran }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $a->jumlah_pembayaran }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $a->status_pembayaran }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-zinc-400">
                                        {{ $a->waktu_pembayaran }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <button onclick="editPembayaran({{ $a }})"
                                            class="text-amber-500 hover:text-amber-600">
                                            Edit
                                        </button>
                                        <button
                                            onclick="deletePembayaran({{ $a->id }}, '{{ $a->reservasi->kode_reservasi }}')"
                                            class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $pembayaran->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Karyawan (Scrollable) -->
    <div id="PembayaranModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tambah Pembayaran</h3>
                <button onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-700 dark:text-zinc-400 dark:hover:text-zinc-300">×</button>
            </div>
            <form action="{{ route('pembayaran.store') }}" method="POST" id="formAbsensiModal">
                @csrf
                <div class="flex flex-col space-y-4">
                    <div>
                        <label for="reservasi_id"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Kode Reservasi</label>
                        <select id="reservasi_id" name="reservasi_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">Pilih...</option>
                            @foreach ($reservasi as $k)
                                <option value="{{ $k->id }}">{{ $k->kode_reservasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        {{-- metode pembayaran berupa option!! --}}
                        <label for="metode_pembayaran"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">Pilih...</option>
                            <option value="transfer bank">Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="kartu kredit">kartu kredit</option>
                            <option value="ewallet">ewallet</option>
                        </select>
                    </div>
                    <div>
                        <label for="jumlah_pembayaran"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Jumlah Pembayaran</label>
                        <input type="number" id="jumlah_pembayaran" name="jumlah_pembayaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>
                    <div>
                        <label for="status_pembayaran"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Status Pembayaran</label>
                        <select id="status_pembayaran" name="status_pembayaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">Pilih...</option>
                            <option value="lunas">Lunas</option>
                            <option value="pending">pending</option>
                            <option value="gagal">Gagal</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-[#FF2D20] text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-300">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:ring-2 focus:ring-gray-300 dark:bg-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-600">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Karyawan (Scrollable) -->
    <div id="PembayaranModalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-zinc-800 rounded-lg p-6 w-11/12 md:w-2/3 lg:w-1/2 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Edit Pembayaran</h3>
                <button onclick="closeModal()"
                    class="text-gray-500 hover:text-gray-700 dark:text-zinc-400 dark:hover:text-zinc-300">×</button>
            </div>
            <form method="POST" id="formPembayaranModalEdit">
                @csrf
                @method('PUT')
                <div class="flex flex-col space-y-4">
                    <div>
                        <label for="reservasi_id_edit"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Kode Reservasi</label>
                        <select id="reservasi_id_edit" name="reservasi_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">Pilih...</option>
                            @foreach ($reservasi as $k)
                                <option value="{{ $k->id }}">{{ $k->kode_reservasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="metode_pembayaran_edit"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Metode Pembayaran</label>
                        <select id="metode_pembayaran_edit" name="metode_pembayaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">Pilih...</option>
                            <option value="transfer bank">Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="kartu kredit">kartu kredit</option>
                            <option value="ewallet">ewallet</option>
                        </select>
                    </div>
                    <div>
                        <label for="jumlah_pembayaran_edit"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Jumlah
                            Pembayaran</label>
                        <input type="number" id="jumlah_pembayaran_edit" name="jumlah_pembayaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                    </div>
                    <div>
                        <label for="status_pembayaran_edit"
                            class="block text-sm font-medium text-gray-700 dark:text-zinc-300">Status
                            Pembayaran</label>
                        <select id="status_pembayaran_edit" name="status_pembayaran" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#FF2D20] focus:border-[#FF2D20] block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white">
                            <option value="">Pilih...</option>
                            <option value="lunas">Lunas</option>
                            <option value="pending">pending</option>
                            <option value="gagal">Gagal</option>
                        </select>
                    </div>

                </div>
                <div class="flex justify-end space-x-4 mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-[#FF2D20] text-white rounded-lg hover:bg-red-600 focus:ring-2 focus:ring-red-300">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:ring-2 focus:ring-gray-300 dark:bg-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-600">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script JavaScript -->
    <script>
        // Modal Tambah Karyawan
        function openModal() {
            document.getElementById('PembayaranModal').classList.remove('hidden');
            document.getElementById('PembayaranModal').classList.add('flex');
        }

        // Modal Edit Karyawan
        function editPembayaran(item) {
            const form = document.getElementById('formPembayaranModalEdit');
            const url = "{{ route('pembayaran.update', ':id') }}".replace(':id', item.id);
            form.setAttribute('action', url);

            // document.getElementById('karyawan_id_edit').value = item.karyawan_id;
            // document.getElementById('tanggal_edit').value = item.tanggal;
            // document.getElementById('shift_id_edit').value = item.shift_id;
            // document.getElementById('jam_masuk_edit').value = item.jam_masuk;
            // document.getElementById('jam_keluar_edit').value = item.jam_keluar;
            // document.getElementById('status_edit').value = item.status;
            // document.getElementById('keterangan_edit').value = item.keterangan;

            document.getElementById('reservasi_id_edit').value = item.reservasi_id;
            document.getElementById('metode_pembayaran_edit').value = item.metode_pembayaran;
            document.getElementById('jumlah_pembayaran_edit').value = item.jumlah_pembayaran;
            document.getElementById('status_pembayaran_edit').value = item.status_pembayaran;

            document.getElementById('PembayaranModalEdit').classList.remove('hidden');
            document.getElementById('PembayaranModalEdit').classList.add('flex');
        }

        // Tutup modal (untuk tambah maupun edit)
        function closeModal() {
            document.getElementById('PembayaranModal').classList.add('hidden');
            document.getElementById('PembayaranModalEdit').classList.add('hidden');
        }


        // Fungsi hapus karyawan
        function deletePembayaran(id, name) {
            if (confirm(`Apakah anda yakin untuk menghapus Pembayaran dengan kode reservasi ${name}?`)) {
                axios.post(`/pembayaran/${id}`, {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}'
                    })
                    .then(() => location.reload())
                    .catch(err => {
                        alert('Error deleting record');
                        console.error(err);
                    });
            }
        }
    </script>
</x-app-layout>
