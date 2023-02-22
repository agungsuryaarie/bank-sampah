<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = 'Jenis Sampah';
        // $user = User::first();

        return view('jenis-sampah.data', compact('menu'));
    }
}
