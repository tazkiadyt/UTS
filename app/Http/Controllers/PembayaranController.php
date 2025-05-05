<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\reservasi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        // try {
        //     $reservasi = reservasi::paginate(10);
        //     $user = User::all();
        //     $tiket = Tiket::all();
        //     return view('page.reservasi.index')->with([
        //         'reservasis' => $reservasi,
        //         'users' => $user,
        //         'tikets' => $tiket
        //     ]);
        // } catch (\Exception $e) {
        //     echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
        //     return view('error.index');
        // }
        try {
            $pembayaran = pembayaran::paginate(10);
            $reservasi = reservasi::all();
            //compact
            return view('page.pembayaran.index', compact('pembayaran', 'reservasi'));
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
    public function create()
    {
    }
    public function store(Request $request)
    {
        try {

            $data = [
                'reservasi_id' => $request->input('reservasi_id'),
                'metode_pembayaran' => $request->input('metode_pembayaran'),
                'jumlah_pembayaran' => $request->input('jumlah_pembayaran'),
                'status_pembayaran' => $request->input('status_pembayaran'),
                'waktu_pembayaran' => now(),
            ];

            pembayaran::create($data);

            return redirect()
                ->route('pembayaran.index')
                ->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
        try {
            $pembayaran = pembayaran::where('id', $id);

            $data = [
                'reservasi_id' => $request->input('reservasi_id'),
                'metode_pembayaran' => $request->input('metode_pembayaran'),
                'jumlah_pembayaran' => $request->input('jumlah_pembayaran'),
                'status_pembayaran' => $request->input('status_pembayaran'),
                'waktu_pembayaran' => now(),
            ];

            $pembayaran->update($data);

            return redirect()
                ->route('pembayaran.index')
                ->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
    public function destroy($id)
    {
        try {
            $pembayaran = pembayaran::findOrFail($id);
            $pembayaran->delete();

            return redirect()
                ->route('pembayaran.index')
                ->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            echo "<script>console.error('PHP Error: " . addslashes($e->getMessage()) . "');</script>";
            return view('error.index');
        }
    }
}
