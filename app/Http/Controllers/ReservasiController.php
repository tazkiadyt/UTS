<?php

namespace App\Http\Controllers;

use App\Models\reservasi;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        try {
            $reservasi = reservasi::paginate(10);
            $user = User::all();
            $tiket = Tiket::all();
            return view('page.reservasi.index')->with([
                'reservasis' => $reservasi,
                'users' => $user,
                'tikets' => $tiket
            ]);
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }

    public function create()
    {
        // Jika diperlukan, kembalikan view untuk form create reservasi
        // return view('page.reservasi.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id'       => 'required',
                'tiket_id'      => 'required',
                'kode_reservasi' => 'required|unique:reservasis,kode_reservasi',
                'jumlah'        => 'required|numeric',
                'total_harga'   => 'required|numeric',
            ]);

            $data = [
                'user_id'       => $request->input('user_id'),
                'tiket_id'      => $request->input('tiket_id'),
                'kode_reservasi' => $request->input('kode_reservasi'),
                'jumlah'        => $request->input('jumlah'),
                'total_harga'   => $request->input('total_harga'),
            ];

            reservasi::create($data);

            return redirect()
                ->route('reservasi.index')
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
                'user_id'       => 'required',
                'tiket_id'      => 'required',
                'kode_reservasi' => 'required|unique:reservasis,kode_reservasi,' . $id,
                'jumlah'        => 'required|numeric',
                'total_harga'   => 'required|numeric',
            ]);

            $data = [
                'user_id'       => $request->input('user_id'),
                'tiket_id'      => $request->input('tiket_id'),
                'kode_reservasi' => $request->input('kode_reservasi'),
                'jumlah'        => $request->input('jumlah'),
                'total_harga'   => $request->input('total_harga'),
            ];

            $reservasi = reservasi::findOrFail($id);
            $reservasi->update($data);

            return redirect()
                ->route('reservasi.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()
                ->route('reservasi.index')
                ->with('error_message', 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $reservasi = reservasi::findOrFail($id);
            $reservasi->delete();
            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error_message', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
