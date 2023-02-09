<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $menu = 'User';
        // $user = User::first();

        return view('user.data', compact('menu'));
    }

    public function create()
    {
        $menu = 'Tambah User';

        return view('user.create', compact('menu'));
    }
    public function edit(Request $request)
    {
        $menu = 'Edit User';

        return view('user.edit', compact('menu'));
    }
}
