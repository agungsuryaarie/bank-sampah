<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $menu = 'User';
        $users = User::whereNot('type', 0)->latest()->get();
        return view('user.data', compact('menu', 'users'));
    }

    public function create()
    {
        $menu = 'Tambah User';

        return view('user.create', compact('menu'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'nohp' => 'required',
            'password' => 'required',
            'photo' => 'required',
            'alamat' => 'required',
            'type' => 'required',
        ]);

        $photo = $request->file('photo');
        $photo->storeAs('public/photo', $photo->hashName());

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'photo' => $photo->hashName(),
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'type' => $request->type,
        ]);

        return redirect()->route('user.index')->with(['success', 'User Berhasil ditambah']);
    }

    public function edit(User $user)
    {
        $menu = 'Edit User';
        return view('user.edit', compact('menu', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'type' => 'required',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/photo', $photo->hashName());

            Storage::delete('public/photo/' . $user->photo);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'photo' => $photo->hashName(),
                'type' => $request->type,
                'alamat' => $request->alamat,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'type' => $request->type,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->route('user.index')->with(['success', 'User Berhasil diupdate']);
    }

    public function password(Request $request, User $user)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);

        $user->update([
            'password' => Hash::make(
                $request->password
            ),
        ]);
        return redirect()->route('user.index')->with(['success', 'Password User Berhasil diupdate']);
    }

    public function destroy(User $user)
    {
        Storage::delete('public/photo/' . $user->photo);
        $user->delete();
        return redirect()->route('user.index')->with(['success' => 'User Berhasil Dihapus!']);
    }
}
