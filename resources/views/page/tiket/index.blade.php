<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-blue-700 bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text">
            MANAJEMEN TIKET
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-100 to-blue-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Form Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Form Input -->
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-700 mb-4">FORM TAMBAH TIKET</h3>
                    <form action="{{ route('tiket.store') }}" method="post">
                        @csrf
                        <div class="space-y-4">
                            <!-- Input Fields -->
                            <div>
                                <x-input-label for="kode_tiket" :value="__('Kode Tiket')" class="text-blue-600" />
                                <x-text-input id="kode_tiket" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" type="text" name="kode_tiket" required />
                            </div>
                            <div>
                                <x-input-label for="nama_event" :value="__('Nama Event')" class="text-blue-600" />
                                <x-text-input id="nama_event" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" type="text" name="nama_event" required />
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="tanggal" :value="__('Tanggal')" class="text-blue-600" />
                                    <x-text-input id="tanggal" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" type="date" name="tanggal" required />
                                </div>
                                <div>
                                    <x-input-label for="waktu" :value="__('Waktu')" class="text-blue-600" />
                                    <x-text-input id="waktu" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" type="time" name="waktu" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="kategori" :value="__('Kategori')" class="text-blue-600" />
                                    <select name="kategori" id="kategori" class="block mt-1 w-full border-blue-300 focus:ring-blue-500 rounded-md shadow-sm">
                                        <option value="">Pilih Kategori</option>
                                        <option value="VIP">VIP</option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="Ekonomi">Ekonomi</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="harga" :value="__('Harga')" class="text-blue-600" />
                                    <x-text-input id="harga" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" type="number" name="harga" readonly />
                                </div>
                            </div>
                            <div>
                                <x-input-label for="stok" :value="__('Stok')" class="text-blue-600" />
                                <x-text-input id="stok" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" type="number" name="stok" required />
                            </div>
                            <x-primary-button class="w-full bg-blue-600 hover:bg-blue-700">
                                SIMPAN TIKET
                            </x-primary-button>
                        </div>
                    </form>
                </div>

                <!-- Table Section -->
                <div class="bg-white p-6 rounded-2xl shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-700 mb-4">DAFTAR TIKET</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase bg-blue-50 text-blue-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">NO</th>
                                    <th scope="col" class="px-6 py-3">KODE</th>
                                    <th scope="col" class="px-6 py-3">EVENT</th>
                                    <th scope="col" class="px-6 py-3">TANGGAL/WAKTU</th>
                                    <th scope="col" class="px-6 py-3">HARGA</th>
                                    <th scope="col" class="px-6 py-3">STOK</th>
                                    <th scope="col" class="px-6 py-3">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tiket as $key => $item)
                                    <tr class="border-b hover:bg-blue-50">
                                        <td class="px-6 py-4">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 font-medium text-blue-600">{{ $item->kode_tiket }}</td>
                                        <td class="px-6 py-4">{{ $item->nama_event }}</td>
                                        <td class="px-6 py-4">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}<br>
                                            {{ $item->waktu }}
                                        </td>
                                        <td class="px-6 py-4">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $item->stok }}</td>
                                        <td class="px-6 py-4 flex gap-2">
                                            <button onclick="editSourceModal(this)" 
                                                data-modal-target="sourceModal"
                                                data-id="{{ $item->id }}"
                                                data-kode_tiket="{{ $item->kode_tiket }}"
                                                data-nama_event="{{ $item->nama_event }}"
                                                data-tanggal="{{ $item->tanggal }}"
                                                data-waktu="{{ $item->waktu }}"
                                                data-harga="{{ $item->harga }}"
                                                data-stok="{{ $item->stok }}"
                                                data-kategori="{{ $item->kategori }}"
                                                class="px-3 py-1 bg-amber-500 text-white rounded hover:bg-amber-600">
                                                Edit
                                            </button>
                                            <button onclick="return produkDelete('{{ $item->id }}','{{ $item->nama_event }}')"
                                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $tiket->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="sourceModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="bg-white rounded-lg p-6 w-full md:w-1/2 mx-4 relative">
            <button onclick="sourceModalClose(this)" data-modal-target="sourceModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h3 id="title_source" class="text-xl font-bold text-blue-700 mb-4">UPDATE TIKET</h3>
            <form id="formSourceModal" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')
                <div>
                    <x-input-label for="kode_tiket_edit" :value="__('Kode Tiket')" class="text-blue-600" />
                    <x-text-input id="kode_tiket_edit" name="kode_tiket" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" />
                </div>
                <div>
                    <x-input-label for="nama_event_edit" :value="__('Nama Event')" class="text-blue-600" />
                    <x-text-input id="nama_event_edit" name="nama_event" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="tanggal_edit" :value="__('Tanggal')" class="text-blue-600" />
                        <x-text-input id="tanggal_edit" name="tanggal" type="date" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" />
                    </div>
                    <div>
                        <x-input-label for="waktu_edit" :value="__('Waktu')" class="text-blue-600" />
                        <x-text-input id="waktu_edit" name="waktu" type="time" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="kategori_edit" :value="__('Kategori')" class="text-blue-600" />
                        <select name="kategori" id="kategori_edit" class="block mt-1 w-full border-blue-300 focus:ring-blue-500 rounded-md shadow-sm">
                            <option value="">Pilih Kategori</option>
                            <option value="VIP">VIP</option>
                            <option value="Reguler">Reguler</option>
                            <option value="Ekonomi">Ekonomi</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="harga_edit" :value="__('Harga')" class="text-blue-600" />
                        <x-text-input id="harga_edit" name="harga" type="number" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" readonly />
                    </div>
                </div>
                <div>
                    <x-input-label for="stok_edit" :value="__('Stok')" class="text-blue-600" />
                    <x-text-input id="stok_edit" name="stok" type="number" class="block mt-1 w-full border-blue-300 focus:ring-blue-500" />
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" onclick="sourceModalClose(this)" data-modal-target="sourceModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                        Batal
                    </button>
                    <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                        Simpan Perubahan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    // Fungsi membuka modal edit tiket
    const editSourceModal = (button) => {
        const formModal = document.getElementById('formSourceModal');
        // Ambil modal dari data-modal-target, atau gunakan id "sourceModal"
        const modalTarget = button.dataset.modalTarget || "sourceModal";
        const modal = document.getElementById(modalTarget);
        
        const id = button.dataset.id;
        const kode_tiket = button.dataset.kode_tiket;
        const nama_event = button.dataset.nama_event;
        const tanggal = button.dataset.tanggal;
        const waktu = button.dataset.waktu;
        const harga = button.dataset.harga;
        const stok = button.dataset.stok;
        const kategori = button.dataset.kategori;
        
        // Ubah judul modal
        document.getElementById('title_source').innerText = `UPDATE TIKET ${nama_event}`;
        // Isi nilai input di modal
        document.getElementById('kode_tiket_edit').value = kode_tiket;
        document.getElementById('nama_event_edit').value = nama_event;
        document.getElementById('tanggal_edit').value = tanggal;
        document.getElementById('waktu_edit').value = waktu;
        document.getElementById('harga_edit').value = harga;
        document.getElementById('stok_edit').value = stok;
        // Set kategori dan trigger event change jika perlu
        const kategoriSelect = document.getElementById('kategori_edit');
        kategoriSelect.value = kategori;
        kategoriSelect.dispatchEvent(new Event('change'));
        
        // Hapus input hidden lama untuk menghindari duplikasi
        document.querySelectorAll('#formSourceModal input[type="hidden"]').forEach(input => input.remove());
        // Tambahkan CSRF token dan _method PATCH kembali
        let csrfToken = document.createElement('input');
        csrfToken.setAttribute('type', 'hidden');
        csrfToken.setAttribute('name', '_token');
        csrfToken.setAttribute('value', '{{ csrf_token() }}');
        formModal.appendChild(csrfToken);
        
        let methodInput = document.createElement('input');
        methodInput.setAttribute('type', 'hidden');
        methodInput.setAttribute('name', '_method');
        methodInput.setAttribute('value', 'PATCH');
        formModal.appendChild(methodInput);
        
        // Atur action form untuk update (ganti :id dengan id yang sesuai)
        formModal.setAttribute('action', "{{ route('tiket.update', ':id') }}".replace(':id', id));
        
        // Tampilkan modal
        modal.classList.remove('hidden');
    }

    // Fungsi menutup modal edit tiket
    const sourceModalClose = (button) => {
        const modalTarget = button.dataset.modalTarget || "sourceModal";
        const modal = document.getElementById(modalTarget);
        // Reset form modal
        document.getElementById('formSourceModal').reset();
        // Sembunyikan modal
        modal.classList.add('hidden');
    }

    // Fungsi hapus tiket dengan konfirmasi
    const produkDelete = async (id, nama) => {
        let tanya = confirm(`Apakah anda yakin untuk menghapus tiket ${nama} ?`);
        if (tanya) {
            try {
                let response = await axios.post(`/tiket/${id}`, {
                    '_method': 'DELETE',
                    '_token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                });
                if (response.status === 200) {
                    alert('Tiket berhasil dihapus');
                    location.reload();
                }
            } catch (error) {
                alert('Error deleting record');
                console.error(error);
            }
        }
    };

    // Update harga berdasarkan kategori untuk form create
    document.addEventListener("DOMContentLoaded", function() {
        let kategoriSelect = document.getElementById("kategori");
        let hargaInput = document.getElementById("harga");
        const hargaKategori = {
            "VIP": 500000,
            "Reguler": 300000,
            "Ekonomi": 200000
        };

        function updateHarga() {
            let selectedKategori = kategoriSelect.value;
            let harga = hargaKategori[selectedKategori] || 0;
            hargaInput.value = harga;
        }

        kategoriSelect.addEventListener("change", updateHarga);
    });

    // Update harga untuk modal edit
    document.addEventListener("DOMContentLoaded", function() {
        let kategoriSelect = document.getElementById("kategori_edit");
        let hargaInput = document.getElementById("harga_edit");
        const hargaKategori = {
            "VIP": 500000,
            "Reguler": 300000,
            "Ekonomi": 200000
        };

        function updateHargaEdit() {
            let selectedKategori = kategoriSelect.value;
            let harga = hargaKategori[selectedKategori] || 0;
            hargaInput.value = harga;
        }

        kategoriSelect.addEventListener("change", updateHargaEdit);
    });
</script>
