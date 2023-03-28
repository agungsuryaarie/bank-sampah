<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenarikanController extends Controller
{
    public function index()
    {
        $menu = 'Penarikan';
        $penarikan = Penarikan::where('nasabah_id', Auth::user()->id)->get();
        $saldo = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->sum('nilai');
        return view('penarikan.nasabah', compact('menu', 'penarikan', 'saldo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nilai' => 'required',
        ]);

        Penarikan::create([
            'nasabah_id' => Auth::user()->id,
            'nilai' => $request->nilai,
            'status' => 1,
        ]);

        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success', 'Jumlah Penarikan Berhasil dikirim']);
    }

    public function update(Request $request, Penarikan $penarikan)
    {
        $this->validate($request, [
            'nilai' => 'required',
        ]);

        $penarikan->update([
            'nasabah_id' => Auth::user()->id,
            'nilai' => $request->nilai,
            'status' => 1,
        ]);

        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success', 'Jumlah Penarikan Berhasil Update']);
    }

    public function destroy(Penarikan $penarikan)
    {
        $penarikan->delete();
        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success' => 'Penarikan Berhasil Dihapus!']);
    }

    public function bendahara()
    {
        $menu = 'Penarikan';
        $penarikan = Penarikan::latest()->paginate(10);

        return view('penarikan.bendahara', compact('menu', 'penarikan'));
    }

    public function aksi(Request $request, Penarikan $penarikan)
    {
        $penarikan->update([
            'status' => $request->status,
        ]);

        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success', 'Status Penarikan Berhasil Update']);
    }
}
