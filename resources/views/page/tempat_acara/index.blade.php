<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-600 bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text">
            {{ __('Manajemen Tempat Acara') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Form Input Tempat Acara -->
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Input Data Tempat Acara</h3>
                    <form action="{{ route('tempat_acara.store') }}" method="post">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="nama" class="block mb-2 text-sm font-medium text-blue-700">Nama</label>
                                <input name="nama" type="text" id="nama" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="alamat" class="block mb-2 text-sm font-medium text-blue-700">Alamat</label>
                                <input name="alamat" type="text" id="alamat" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="kapasitas" class="block mb-2 text-sm font-medium text-blue-700">Kapasitas</label>
                                <input name="kapasitas" type="text" id="kapasitas" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="kontak" class="block mb-2 text-sm font-medium text-blue-700">Kontak</label>
                                <input name="kontak" type="text" id="kontak" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div>
                                <label for="deskripsi" class="block mb-2 text-sm font-medium text-blue-700">Deskripsi</label>
                                <input name="deskripsi" type="text" id="deskripsi" 
                                    class="bg-blue-50 border border-blue-300 text-blue-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                SIMPAN
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Tabel Data Tempat Acara -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-blue-600 mb-4">Daftar Tempat Acara</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-blue-800">
                            <thead class="text-xs uppercase bg-blue-100 text-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">NO</th>
                                    <th scope="col" class="px-6 py-3">NAMA</th>
                                    <th scope="col" class="px-6 py-3">ALAMAT</th>
                                    <th scope="col" class="px-6 py-3">KAPASITAS</th>
                                    <th scope="col" class="px-6 py-3">KONTAK</th>
                                    <th scope="col" class="px-6 py-3">DESKRIPSI</th>
                                    <th scope="col" class="px-6 py-3">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($tempat_acara as $t)
                                    <tr class="bg-white border-b hover:bg-blue-50">
                                        <td class="px-6 py-4">{{ $no++ }}</td>
                                        <td class="px-6 py-4 font-medium text-blue-600">{{ $t->nama }}</td>
                                        <td class="px-6 py-4">{{ $t->alamat }}</td>
                                        <td class="px-6 py-4">{{ $t->kapasitas }}</td>
                                        <td class="px-6 py-4">{{ $t->kontak }}</td>
                                        <td class="px-6 py-4">{{ $t->deskripsi }}</td>
                                        <td class="px-6 py-4">
                                            <button type="button" data-id="{{ $t->id }}" data-modal-target="acaraModal"
                                                data-nama="{{ $t->nama }}" data-alamat="{{ $t->alamat }}" 
                                                data-kapasitas="{{ $t->kapasitas }}" data-kontak="{{ $t->kontak }}" 
                                                data-deskripsi="{{ $t->deskripsi }}"
                                                onclick="editAcaraModal(this)"
                                                class="bg-amber-500 hover:bg-amber-600 px-3 py-1 rounded-md text-xs text-white">
                                                Edit
                                            </button>
                                            <form action="{{ route('tempat_acara.destroy', $t->id) }}" method="POST" class="inline">
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
                        {{ $tempat_acara->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tempat Acara -->
    <div id="acaraModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 relative">
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-xl font-bold text-blue-600" id="modalTitle">Edit Tempat Acara</h3>
                <button type="button" onclick="closeAcaraModal()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>
            <form id="acaraForm" action="" method="POST" class="space-y-4 pt-4">
                @csrf
                @method('PATCH')
                <div>
                    <label for="nama_edit" class="block text-sm font-medium text-blue-700">Nama</label>
                    <input type="text" id="nama_edit" name="nama" class="w-full border border-blue-300 rounded-md p-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="alamat_edit" class="block text-sm font-medium text-blue-700">Alamat</label>
                    <input type="text" id="alamat_edit" name="alamat" class="w-full border border-blue-300 rounded-md p-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="kapasitas_edit" class="block text-sm font-medium text-blue-700">Kapasitas</label>
                    <input type="text" id="kapasitas_edit" name="kapasitas" class="w-full border border-blue-300 rounded-md p-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="kontak_edit" class="block text-sm font-medium text-blue-700">Kontak</label>
                    <input type="text" id="kontak_edit" name="kontak" class="w-full border border-blue-300 rounded-md p-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="deskripsi_edit" class="block text-sm font-medium text-blue-700">Deskripsi</label>
                    <input type="text" id="deskripsi_edit" name="deskripsi" class="w-full border border-blue-300 rounded-md p-2 focus:ring-blue-500" />
                </div>
                <div class="flex items-center justify-end pt-4 border-t">
                    <button type="button" onclick="closeAcaraModal()" class="mr-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    // Fungsi membuka modal edit dan mengisi form dengan data yang ada
    function editAcaraModal(button) {
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const alamat = button.getAttribute('data-alamat');
        const kapasitas = button.getAttribute('data-kapasitas');
        const kontak = button.getAttribute('data-kontak');
        const deskripsi = button.getAttribute('data-deskripsi');

        // Isi nilai input di modal
        document.getElementById('nama_edit').value = nama;
        document.getElementById('alamat_edit').value = alamat;
        document.getElementById('kapasitas_edit').value = kapasitas;
        document.getElementById('kontak_edit').value = kontak;
        document.getElementById('deskripsi_edit').value = deskripsi;

        // Atur action form ke route update (misal: /tempat_acara/{id})
        document.getElementById('acaraForm').action = `/tempat_acara/${id}`;

        // Tampilkan modal
        document.getElementById('acaraModal').classList.remove('hidden');
    }

    // Fungsi menutup modal dan mereset form
    function closeAcaraModal() {
        document.getElementById('acaraModal').classList.add('hidden');
        document.getElementById('acaraForm').reset();
    }
</script>
