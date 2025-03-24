<?php

namespace App\Http\Controllers;

use App\Models\tempat_acara;
use Illuminate\Http\Request;

class TempatAcaraController extends Controller
{
    public function index()
    {
        try {
            $tempat_acara = tempat_acara::paginate(10);
            return view('page.tempat_acara.index')->with([
                'tempat_acara' => $tempat_acara
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function create()
    {
        // Jika diperlukan, kembalikan view untuk form create
        // return view('page.tempat_acara.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama'      => 'required',
                'alamat'    => 'required',
                'kapasitas' => 'required|numeric',
                'kontak'    => 'required',
                'deskripsi' => 'required',
            ]);

            $data = [
                'nama'      => $request->input('nama'),
                'alamat'    => $request->input('alamat'),
                'kapasitas' => $request->input('kapasitas'),
                'kontak'    => $request->input('kontak'),
                'deskripsi' => $request->input('deskripsi'),
            ];

            tempat_acara::create($data);

            return redirect()
                ->route('tempat_acara.index')
                ->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama'      => 'required',
                'alamat'    => 'required',
                'kapasitas' => 'required|numeric',
                'kontak'    => 'required',
                'deskripsi' => 'required',
            ]);

            $data = [
                'nama'      => $request->input('nama'),
                'alamat'    => $request->input('alamat'),
                'kapasitas' => $request->input('kapasitas'),
                'kontak'    => $request->input('kontak'),
                'deskripsi' => $request->input('deskripsi'),
            ];

            $tempat_acara = tempat_acara::findOrFail($id);
            $tempat_acara->update($data);

            return redirect()
                ->route('tempat_acara.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->route('tempat_acara.index')
                ->with('error_message', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $data = tempat_acara::findOrFail($id);
            $data->delete();
            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
