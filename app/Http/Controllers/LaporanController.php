<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

use function PHPUnit\Framework\returnSelf;

class LaporanController extends Controller
{

    public function data($awal, $akhir)
    {
        $data = [];
        $pendapatan = 0;
        $total_pendapatan = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal  = date('Y-m-d', strtotime("+1 day", strtotime($awal)));
            $penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $pengeluaran = Pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');

            $pendapatan = $penjualan - ($pembelian + $pengeluaran);
            $total_pendapatan += $pendapatan;

            $rows = [];
            $rows['tanggal'] = format_tanggal_indo($tanggal);
            $rows['penjualan'] = $penjualan === 0 ? "-" : format_idr($penjualan);
            $rows['pembelian'] = $pembelian === 0 ? "-" : format_idr($pembelian);
            $rows['pengeluaran'] = $pengeluaran === 0 ? "-" : format_idr($pengeluaran);
            $rows['pendapatan'] = $pendapatan === 0 ? "-" : '<div class="font-weight-bold">' . format_idr($pendapatan) . '</div>';

            $data[] = $rows;
        }

        $data[] = [
            'tanggal' => '',
            'penjualan' => '',
            'pembelian' => '',
            'pengeluaran' => 'Total Pendapatan',
            'pendapatan' => '<div class="font-weight-bold">' . format_idr($total_pendapatan) . '</div>',
        ];

        return DataTables::of($data)
            ->addIndexColumn()
            ->rawColumns(['pendapatan'])
            ->make(true);
    }
    public function index(Request $request)
    {
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $awal = $request->tanggal_awal;
            $akhir = $request->tanggal_akhir;
        } else {
            $awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
            $akhir = date('Y-m-d');
        }

        return view('page.laporan.index', compact(['awal', 'akhir']));
    }
}
