<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
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
        $debit = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->sum('nilai');
        $kredit = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'kredit')->sum('nilai');
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
        return view('dashboard', compact('saldo', 'debit', 'kredit'));
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
