<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function index()
    {
        $menu = 'Transaksi';
        $transaksi = Transaksi::get();
        $user = User::where('type', 0)->get();
        $sampah = Sampah::get();
        return view('transaksi.data', compact('menu', 'transaksi', 'user', 'sampah'));
    }

    public function getSampah($id)
    {
        $sampah = Sampah::find($id);
        return response()->json($sampah);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sampah_id' => 'required',
            'nasabah_id' => 'required',
            'berat' => 'required',
            'total' => 'required',
        ]);

        Transaksi::create([
            'user_id' => 1,
            'sampah_id' => $request->sampah_id,
            'nasabah_id' => $request->nasabah_id,
            'harga_nasabah' => $request->harga_nasabah,
            'berat' => $request->berat,
            'total' => $request->total,
        ]);

        return redirect()->route('transaksi.index')->with(['success', 'Transaksi Berhasil ditambah']);
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with(['success' => 'Transaksi Berhasil Dihapus!']);
    }
}
