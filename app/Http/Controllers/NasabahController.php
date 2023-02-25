<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NasabahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = 'Nasabah';
        $customers = User::where('type', 0)->latest()->get();
        return view('nasabah.data', compact('menu', 'customers'));
    }

    public function create()
    {
        $menu = 'Tambah Nasabah';

        return view('nasabah.create', compact('menu'));
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {

        // dd($request);
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

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'photo' => $photo->hashName(),
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'type' => 0,
        ]);

        $saldo = new Saldo;
        $saldo->nasabah_id = $user->id;
        $saldo->saldo = 0;
        $saldo->save();

        return redirect()->route(Auth::user()->type . '.nasabah.index')->with(['success', 'Nasabah Berhasil ditambah']);
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
            'email' => 'required',
            'nohp' => 'required',
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
                'email' => $request->email,
                'nohp' => $request->nohp,
                'type' => 0,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->route(Auth::user()->type . '.nasabah.index')->with(['success', 'Nasabah Berhasil diupdate']);
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
        return redirect()->route(Auth::user()->type . '.nasabah.index')->with(['success', 'Password Nasabah Berhasil diupdate']);
    }

    public function destroy(User $user)
    {
        Storage::delete('public/photo/' . $user->photo);
        $user->delete();
        return redirect()->route(Auth::user()->type . '.nasabah.index')->with(['success' => 'Nasabah Berhasil Dihapus!']);
    }
}
