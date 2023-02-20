<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home.nasabah');
    }

    public function pengurus()
    {
        return view('home.pengurus');
    }

    public function bendahara()
    {
        return view('home.bendahara');
    }

    public function admin()
    {
        return view('home.admin');
    }
}
