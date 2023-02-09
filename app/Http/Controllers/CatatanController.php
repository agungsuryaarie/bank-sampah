<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $menu = 'Catatan';
        return view('catatan.data', compact('menu'));
    }
}
