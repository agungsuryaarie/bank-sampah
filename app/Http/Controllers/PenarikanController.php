<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Saldo;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PenarikanController extends Controller
{
    public function index()
    {
        $menu = 'Penarikan';
        $penarikan = Penarikan::where('nasabah_id', Auth::user()->id)->latest()->get();
        $saldo = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->sum('nilai');
        $nilaipenarikan = $penarikan->sum('nilai');
        // dd($penarikan->sum('nilai'));
        $totalsaldo = $saldo - $nilaipenarikan;
        return view('penarikan.nasabah', compact('menu', 'penarikan', 'saldo', 'totalsaldo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nilai' => 'required',
        ]);

        $penarikan = Penarikan::where('nasabah_id', Auth::user()->id)->get();
        $saldo = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->sum('nilai');
        $nilaipenarikan = $penarikan->sum('nilai');
        $totalsaldo = $saldo - $nilaipenarikan;

        if ($request->nilai > $totalsaldo) {
            // return back()->with(['success' => 'Jumlah penarikan melebihi nilai saldo']);
            return redirect()->route(Auth::user()->type . '.penarikan')->with(['success' => 'Penarikan Berhasil Dihapus!']);
        }

        Penarikan::create([
            'nasabah_id' => Auth::user()->id,
            'nilai' => $request->nilai,
            'status' => 1,
        ]);
        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success' => 'Jumlah Penarikan Berhasil dikirim']);
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

        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success' => 'Jumlah Penarikan Berhasil Update']);
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

        if ($request->tanggal == null) {
            $penarikan->update([
                'status' => $request->status,
                'created_at' => Carbon::now(),
            ]);

            if ($request->status == 2) {
                $saldo = Saldo::where('nasabah_id', $penarikan->nasabah_id)->first();
                $saldo->saldo = $saldo->saldo - $penarikan->nilai;
                $saldo->save();
            }

            Transaksi::create([
                'nasabah_id' => $penarikan->nasabah_id,
                'status' => 'kredit',
                'nilai' => $penarikan->nilai,
                'penarikan_id' => $penarikan->id,
                'created_at' => Carbon::now(),
            ]);
        } else {
            $penarikan->update([
                'created_at' => $request->tanggal,
                'status' => $request->status,
            ]);

            if ($request->status == 2) {
                $saldo = Saldo::where('nasabah_id', $penarikan->nasabah_id)->first();
                $saldo->saldo = $saldo->saldo - $penarikan->nilai;
                $saldo->save();
            }

            Transaksi::create([
                'nasabah_id' => $penarikan->nasabah_id,
                'status' => 'kredit',
                'nilai' => $penarikan->nilai,
                'penarikan_id' => $penarikan->id,
                'created_at' => $request->tanggal,
            ]);
        }

        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success' => 'Status Penarikan Berhasil Update']);
    }

    public function updateTanggal(Request $request, Penarikan $penarikan)
    {
        $penarikan->update([
            'created_at' => $request->tanggal,
        ]);

        $transaksi = Transaksi::where('penarikan_id', $penarikan->id);

        $transaksi->update([
            'created_at' => $request->tanggal,
        ]);

        return redirect()->route(Auth::user()->type . '.penarikan')->with(['success' => 'Status Penarikan Berhasil Update']);
    }
}
