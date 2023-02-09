<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NasabahController extends Controller
{
    public function index()
    {
        $menu = 'Nasabah';
        // $user = User::first();

        return view('nasabah.data', compact('menu'));
    }
}
