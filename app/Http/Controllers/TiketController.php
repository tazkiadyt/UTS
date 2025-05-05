<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        try {
            $tiket = Tiket::paginate(10);
            return view('page.tiket.index')->with([
                'tiket' => $tiket
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function create() {}

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kode_tiket' => 'required|unique:tikets,kode_tiket',
                'nama_event' => 'required',
                'tanggal' => 'required|date',
                'waktu' => 'required',
                'harga' => 'required',
                'stok' => 'required|numeric',
                'kategori' => 'required',
            ]);

            $data = [
                'kode_tiket' => $request->input('kode_tiket'),
                'nama_event' => $request->input('nama_event'),
                'tanggal' => $request->input('tanggal'),
                'waktu' => $request->input('waktu'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok'),
                'kategori' => $request->input('kategori'),
            ];

            Tiket::create($data);

            return redirect()
                ->route('tiket.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'kode_tiket' => 'required|unique:tikets,kode_tiket,' . $id,
                'nama_event' => 'required',
                'tanggal' => 'required|date',
                'waktu' => 'required',
                'harga' => 'required',
                'stok' => 'required|numeric',
                'kategori' => 'required',
            ]);

            // Ambil data yang diinputkan
            $data = [
                'kode_tiket' => $request->input('kode_tiket'),
                'nama_event' => $request->input('nama_event'),
                'tanggal' => $request->input('tanggal'),
                'waktu' => $request->input('waktu'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok'),
                'kategori' => $request->input('kategori'),
            ];

            // Cari data tiket berdasarkan ID
            $tiket = Tiket::findOrFail($id);

            // Update data
            $tiket->update($data);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()
                ->route('tiket.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            // Redirect ke halaman index dengan pesan error jika terjadi kesalahan
            return redirect()
                ->route('tiket.index')
                ->with('error_message', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $data = Tiket::findOrFail($id);
            $data->delete();
            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error_mesaage', 'Terjadi kesalahan saat melakukan delete data: ' . $e->getMessage());
        }
    }
}
