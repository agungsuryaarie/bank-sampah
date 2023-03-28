<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function hispenjualan()
    {
        $menu = 'Histori Penjualan';
        $penjualan = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->paginate(5);

        return view('history.penjualan', compact('menu', 'penjualan'));
    }

    public function hispenarikan()
    {
        $menu = 'Histori Penarikan';
        $penarikan = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'kredit')->paginate(5);
        $saldo = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'kredit')->sum('nilai');

        return view('history.penarikan', compact('menu', 'penarikan', 'saldo'));
    }
}
