<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $menu = 'Penjualan';
        // $user = User::first();

        return view('penjualan.data', compact('menu'));
    }
}
