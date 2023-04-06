<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Saldo;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $pembelian = Transaksi::select(DB::raw("sum(nilai) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->where('status', 'debit')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name', 'DESC')
            ->pluck('count', 'month_name');

        $labelPembelian = $pembelian->keys();
        $dataPembelian = $pembelian->values();

        $penarikan = Transaksi::select(DB::raw("sum(nilai) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->where('status', 'kredit')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name', 'DESC')
            ->pluck('count', 'month_name');

        $labelPenarikan = $penarikan->keys();
        $dataPenarikan = $penarikan->values();

        $persenSampah = Transaksi::select(DB::raw("sum(berat) as count"), DB::raw("sampah_id as sampah"))
            ->where('status', 'debit')
            ->groupBy(DB::raw("sampah"))
            ->orderBy('sampah', 'DESC')
            ->pluck('count', 'sampah');

        $labelpersenSampah = $persenSampah->keys();
        $datapersenSampah = $persenSampah->values();

        return view('dashboard', compact('labelPembelian', 'dataPembelian', 'labelPenarikan', 'dataPenarikan', 'labelpersenSampah', 'datapersenSampah', 'totalSampah'));
    }
}
