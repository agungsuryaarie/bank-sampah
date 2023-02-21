<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class NasabahController extends Controller
{
    public function index()
    {
        $menu = 'Nasabah';
        $customers = User::where('type', 0)->get();
        return view('nasabah.data', compact('menu', 'customers'));
    }

    public function create()
    {
        $menu = 'Tambah Nasabah';

        return view('nasabah.create', compact('menu'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'nohp' => 'required',
            'password' => 'required',
            'alamat' => 'required',
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
            'type' => 0,
        ]);

        return redirect()->route('nasabah.index')->with(['success', 'Nasabah Berhasil ditambah']);
    }

    public function edit(User $user)
    {
        $menu = 'Edit Nasabah';

        return view('nasabah.edit', compact('menu', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
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
                'type' => 0,
                'alamat' => $request->alamat,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'nohp' => $request->nohp,
                'type' => 0,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->route('nasabah.index')->with(['success', 'Nasabah Berhasil diupdate']);
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
        return redirect()->route('nasabah.index')->with(['success', 'Password Nasabah Berhasil diupdate']);
    }

    public function destroy(User $user)
    {
        Storage::delete('public/photo/' . $user->photo);
        $user->delete();
        return redirect()->route('nasabah.index')->with(['success' => 'Nasabah Berhasil Dihapus!']);
    }
}
