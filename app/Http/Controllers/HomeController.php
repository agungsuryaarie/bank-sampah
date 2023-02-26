<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nasabah(Request $request)
    {

        $saldo = Saldo::where('nasabah_id', Auth::user()->id)->first();

        if ($request->ajax()) {
            $data = Transaksi::where('status', 'debit')
                ->where('nasabah_id', Auth::user()->id)
                ->latest()->get();
            return datatables()::of($data)
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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs edit"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs delete"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard', compact('saldo'));
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
