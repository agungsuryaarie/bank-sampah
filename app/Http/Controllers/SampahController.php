<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SampahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $menu = 'Jenis Sampah';
        $sampah = Sampah::latest()->get();
        return view('jenis-sampah.data', compact('menu', 'sampah'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis' => 'required',
            'harga_nasabah' => 'required',
            'harga_pengepul' => 'required',
            'berat' => 'required',
            'gambar' => 'required',
        ]);

        $gambar = $request->file('gambar');
        $gambar->storeAs('public/sampah', $gambar->hashName());

        Sampah::create([
            'jenis' => $request->jenis,
            'harga_nasabah' => $request->harga_nasabah,
            'harga_pengepul' => $request->harga_pengepul,
            'berat' => $request->berat,
            'gambar' => $gambar->hashName(),
        ]);

        return redirect()->route(Auth::user()->type . '.sampah.index')->with(['success' => 'Jenis Sampah Berhasil ditambah']);
    }

    public function update(Request $request, Sampah $sampah)
    {
        $this->validate($request, [
            'jenis' => 'required',
            'harga_nasabah' => 'required',
            'harga_pengepul' => 'required',
            'berat' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/gambar', $gambar->hashName());

            Storage::delete('public/gambar/' . $sampah->gambar);

            $sampah->update([
                'jenis' => $request->jenis,
                'harga_nasabah' => $request->harga_nasabah,
                'harga_pengepul' => $request->harga_pengepul,
                'berat' => $request->berat,
                'gambar' => $gambar->hashName(),
            ]);
        } else {
            $sampah->update([
                'jenis' => $request->jenis,
                'harga_nasabah' => $request->harga_nasabah,
                'harga_pengepul' => $request->harga_pengepul,
                'berat' => $request->berat,
            ]);
        }

        return redirect()->route(Auth::user()->type . '.sampah.index')->with(['success' => 'Jenis Sampah Berhasil diupdate']);
    }

    public function destroy(Sampah $sampah)
    {
        Storage::delete('public/sampah/' . $sampah->photo);
        $sampah->delete();
        return redirect()->route(Auth::user()->type . '.sampah.index')->with(['success' => 'Jenis Sampah Berhasil Dihapus!']);
    }
}
