<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        $menu = 'Keuangan';
        // $user = User::first();

        return view('keuangan.data', compact('menu'));
    }
    public function penjualan()
    {
        $menu = 'Histori Penjualan';
        // $user = User::first();

        return view('history.penjualan', compact('menu'));
    }
    public function penarikan()
    {
        $menu = 'Histori Penarikan';
        // $user = User::first();

        return view('history.penarikan', compact('menu'));
    }
}
