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
}
