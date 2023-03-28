<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nasabah(Request $request)
    {

        $saldo = Saldo::where('nasabah_id', Auth::user()->id)->first();

        if ($request->ajax()) {
            $data = Transaksi::where('nasabah_id', Auth::user()->id)
                ->latest()->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($data) {
                    return $data->created_at->format('d/m/y');
                })
                ->addColumn('keterangan', function ($data) {
                    if ($data->status == 'debit') {
                        return  'Penjualan';
                    }
                    if ($data->status == 'kredit') {
                        return 'Penarikan';
                    }
                })
                ->addColumn('nilai', function ($data) {
                    return "Rp " . $data->nilai;
                })
                ->rawColumns(['keterangan'])
                ->make(true);
        }
        return view('dashboard', compact('saldo'));
    }

    public function Transaksi(Request $request)
    {
        $menu = 'Transaksi';
        $transaksi = Transaksi::where('nasabah_id', Auth::user()->id)->get();
        return view('nasabah.transaksi', compact('menu', 'transaksi'));
    }

    public function penjualan()
    {
        $menu = 'Histori Penjualan';
        $penjualan = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->paginate(5);

        return view('nasabah.penjualan', compact('menu', 'penjualan'));
    }

    public function penarikan()
    {
        $menu = 'Histori Penarikan';
        $penarikan = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'kredit')->paginate(5);
        $saldo = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'kredit')->sum('nilai');

        return view('nasabah.penarikan', compact('menu', 'penarikan', 'saldo'));
    }

    public function pengurus()
    {
        return view('dashboard');
    }

    public function bendahara()
    {
        return view('dashboard');
    }

    public function admin()
    {
        return view('dashboard');
    }
}
