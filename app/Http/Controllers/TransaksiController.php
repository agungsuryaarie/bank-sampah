<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Sampah;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Yajra\Datatables\Datatables;

class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $menu = 'Transaksi';
        $user = User::where('type', 0)->get();
        if ($request->ajax()) {
            $data = Transaksi::where('status', 'debit')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($data) {
                    return $data->created_at->format('d-m-y');
                })
                ->addColumn('nasabah', function ($data) {
                    return $data->nasabah->name;
                })
                ->addColumn('petugas', function ($data) {
                    return $data->petugas->name;
                })
                ->addColumn('sampah', function ($data) {
                    return $data->sampah->jenis;
                })
                ->addColumn('action', function ($data) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('transaksi.data', compact('menu', 'user'));
    }

    public function getSampah($id)
    {
        $sampah = Sampah::find($id);
        return response()->json($sampah);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sampah_id' => 'required',
            'nasabah_id' => 'required',
            'berat' => 'required',
            'nilai' => 'required',
        ]);

        Transaksi::create([
            'petugas_id' => Auth::user()->id,
            'sampah_id' => $request->sampah_id,
            'nasabah_id' => $request->nasabah_id,
            'harga_nasabah' => $request->harga_nasabah,
            'berat' => $request->berat,
            'status' => 'debit',
            'nilai' => $request->nilai,
            'created_at' => $request->created_at,
        ]);


        $saldo = Saldo::where('nasabah_id', $request->nasabah_id)->first();
        $saldo->saldo = $saldo->saldo + $request->nilai;
        $saldo->save();

        return response()->json(['success' => 'Transaksi Berhasil ditambah.']);
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        return response()->json($transaksi);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $this->validate($request, [
            'sampah_id' => 'required',
            'nasabah_id' => 'required',
            'berat' => 'required',
            'nilai' => 'required',
        ]);
        // $transaksi = Transaksi::where('id', $id)->first();

        $saldo = Saldo::where('nasabah_id', $request->nasabah_id)->first();
        $kembalikan = $saldo->saldo - $transaksi->nilai;
        $saldo->saldo =  $kembalikan + $request->nilai;
        $saldo->save();

        $transaksi->update([
            'petugas_id' => Auth::user()->id,
            'sampah_id' => $request->sampah_id,
            'nasabah_id' => $request->nasabah_id,
            'harga_nasabah' => $request->harga_nasabah,
            'berat' => $request->berat,
            'status' => 'debit',
            'nilai' => $request->nilai,
            'created_at' => $request->created_at,
        ]);
        return response()->json(['success' => 'Transaksi Berhasil diubah.']);
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return response()->json(['success' => 'Transaksi Berhasil Dihapus!']);
    }
}
