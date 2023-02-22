<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nasabah()
    {
        return view('dashboard');
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
