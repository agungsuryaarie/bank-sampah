<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use App\Models\Saldo;
use App\Models\Sampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nasabah(Request $request)
    {
        $debit = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'debit')->sum('nilai');
        $kredit = Transaksi::where('nasabah_id', Auth::user()->id)->where('status', 'kredit')->sum('nilai');
        $saldo = Saldo::where('nasabah_id', Auth::user()->id)->first();


        if ($request->ajax()) {
            $data = Transaksi::where('nasabah_id', Auth::user()->id)
                ->latest()->get();
            return datatables()::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($data) {
                    return $data->created_at->format('d/m/y');
                })
                ->addColumn('keterangan', function ($data) {
                    if ($data->status == 'debit') {
                        return  'Penjualan';
                    }
                    if ($data->status == 'kredit') {
                        return 'Penarikan';
                    }
                })
                ->addColumn('nilai', function ($data) {
                    return "Rp " . $data->nilai;
                })
                ->rawColumns(['keterangan'])
                ->make(true);
        }
        return view('dashboard', compact('saldo', 'debit', 'kredit'));
    }

    public function dashboard()
    {
        $tot_transaksi = Transaksi::count();
        $tot_berat = Transaksi::where('status', 'debit')->sum('berat');
        $pembelian = Transaksi::where('status', 'debit')->sum('nilai');
        $penarikan = Transaksi::where('status', 'kredit')->sum('nilai');

        $tot_pembelian = number_format($pembelian, 0, ',', '.');
        $tot_penarikan = number_format($penarikan, 0, ',', '.');
        return view('dashboard', compact('tot_transaksi', 'tot_berat', 'tot_pembelian', 'tot_penarikan'));
    }

    public function calculatePercentage($weight, $totalWeight)
    {
        if ($totalWeight == 0) {
            return 0; // Avoid division by zero if totalWeight is zero
        }

        $percentage = ($weight / $totalWeight) * 100;

        return round($percentage, 2); // Round the percentage to 2 decimal places
    }

    public function getData()
    {
        $pembelian = Transaksi::selectRaw("sum(nilai) as count, MONTHNAME(created_at) as month_name")
            ->where('status', 'debit')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name', 'ASC')
            ->get('count', 'month_name');

        foreach ($pembelian as $row) {
            $data['labelPembelian'][] = $row->month_name;
            $data['dataPembelian'][] = (int) $row->count;
        }

        $penarikan = Transaksi::selectRaw("sum(nilai) as count, MONTHNAME(created_at) as month_name")
            ->where('status', 'kredit')
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month_name"))
            ->orderBy('month_name', 'ASC')
            ->get('count', 'month_name');

        foreach ($penarikan as $row) {
            $data['labelPenarikan'][] = $row->month_name;
            $data['dataPenarikan'][] = (int) $row->count;
        }


        $sampah = Transaksi::with('sampah')
            ->selectRaw('sum(berat) as count, sampah_id')
            ->where('status', 'debit')
            ->groupBy('sampah_id')
            ->orderBy('sampah_id', 'DESC')
            ->get(['count', 'sampah.jenis']);

        // Hitung total berat sampah
        $totalWeight = $sampah->sum('count');

        // Hitung persentase berat sampah dan format data untuk Chart.js
        foreach ($sampah as $item) {
            $data['labelSampah'][] = $item['sampah']['jenis'];
            $percentage = $this->calculatePercentage($item['count'], $totalWeight);
            $data['dataSampah'][] = $percentage;
        }


        $sampah_bar = Transaksi::selectRaw('sum(berat) as total_berat, YEAR(created_at) as tahun, MONTH(created_at) as bulan')
            ->where('status', 'debit')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'ASC')
            ->orderBy('bulan', 'ASC')
            ->get();

        foreach ($sampah_bar as $item) {
            $bulan = Carbon::createFromDate($item->tahun, $item->bulan, 1)->format('F Y');
            $data['labelSampahBar'][] = $bulan;
            $data['dataSampahBar'][] = $item->total_berat;
        }

        return response()->json($data);
    }
}
