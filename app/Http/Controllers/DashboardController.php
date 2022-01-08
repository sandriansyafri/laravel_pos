<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Member;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use GuzzleHttp\RetryMiddleware;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class DashboardController extends Controller
{
    public function dashboardKasir()
    {
        return view('page.dashboard-kasir');
    }
    public function index()
    {

        $total_penjualan = 0;
        $total_pembelian = 0;
        $total_pengeluaran = 0;
        $total_pendapatan = 0;

        $tanggal = [
            'first' => date('Y-m-d', mktime(0, 0, 0, date('m'), 01, date('Y'))),
            'awal' => date('Y-m-d', mktime(0, 0, 0, date('m'), 01, date('Y'))),
            'akhir' => date('Y-m-d')
        ];

        $data_labels_pendapatan = ['Pendapatan'];
        $data_bar_pendapatan = [];

        foreach ($data_labels_pendapatan as $index => $label) {
            $data_bar_pendapatan[$index]['label'] = $label;
            $data_bar_pendapatan[$index]['backgroundColor'] = "rgba(60,141,188,0.9)";
            $data_month = [];


            foreach (range(1, 12) as $month) {
                $penjualan = Penjualan::whereMonth('updated_at', $month)->sum('bayar');
                $pembelian = Pembelian::whereMonth('updated_at', $month)->sum('bayar');
                $pengeluaran = Pengeluaran::whereMonth('updated_at', $month)->sum('nominal');

                $data_month[] = (int)$penjualan - ((int)$pembelian + (int)$pengeluaran);
            }

            $data_bar_pendapatan[$index]['data'] = $data_month;
        }

        $data_labels_pengeluaran = ["Pengeluaran"];
        $data_bar_pengeluaran = [];

        foreach ($data_labels_pengeluaran as $index => $labels_pengeluaran) {
            $data_bar_pengeluaran[$index]['label'] = $labels_pengeluaran;
            $data_bar_pengeluaran[$index]['backgroundColor'] = "rgba(00,111,88,0.9)";

            $data_month = [];
            foreach (range(1, 12) as $month) {
                $pengeluaran = Pengeluaran::whereMonth('updated_at', $month)->sum('nominal');

                $data_month[] = $pengeluaran;
            }

            $data_bar_pengeluaran[$index]['data'] = $data_month;
        }

        $data_labels_pembelian = ["Pembelian"];
        $data_bar_pembelian = [];

        foreach ($data_labels_pembelian as $index => $labels_pembelian) {
            $data_bar_pembelian[$index]['label'] = $labels_pembelian;
            $data_bar_pembelian[$index]['backgroundColor'] = "rgba(200,141,188,0.9)";

            $data_month = [];
            foreach (range(1, 12) as $month) {
                $pembelian = Pembelian::whereMonth('updated_at', $month)->sum('bayar');

                $data_month[] = $pembelian;
            }

            $data_bar_pembelian[$index]['data'] = $data_month;
        }

        $data_labels_penjualan = ["Penjualan"];
        $data_bar_penjualan = [];

        foreach ($data_labels_penjualan as $index => $labels_penjualan) {
            $data_bar_penjualan[$index]['label'] = $labels_penjualan;
            $data_bar_penjualan[$index]['backgroundColor'] = "rgba(00,141,188,0.9)";

            $data_month = [];
            foreach (range(1, 12) as $month) {
                $penjualan = Penjualan::whereMonth('updated_at', $month)->sum('bayar');

                $data_month[] = $penjualan;
            }

            $data_bar_penjualan[$index]['data'] = $data_month;
        }


        while (strtotime($tanggal['awal']) <= strtotime($tanggal['akhir'])) {
            $tgl = $tanggal['awal'];
            $tanggal['awal'] = date('Y-m-d', strtotime("+1 day", strtotime($tanggal['awal'])));

            $penjualan = Penjualan::where('updated_at', 'LIKE', "%$tgl%")->sum('bayar');
            $pembelian = Pembelian::where('updated_at', 'LIKE', "%$tgl%")->sum('bayar');
            $pengeluaran = Pengeluaran::where('updated_at', 'LIKE', "%$tgl%")->sum('nominal');
            $total_penjualan += $penjualan;
            $total_pembelian += $pembelian;
            $total_pengeluaran += $pengeluaran;
            $total_pendapatan +=  $total_penjualan - ($total_pembelian + $total_pengeluaran);
        }

        $chart_1 = [
            'label' =>  ['Penjualan', 'Pembelian', 'Pengeluaran', 'Pendapatan'],
            'data' =>  [$total_penjualan, $total_pembelian, $total_pengeluaran, $total_pendapatan]
        ];

        $statistik = collect([
            'produk' => Produk::count(),
            'kategori' => Kategori::count(),
            'member' => Member::count(),
            'supplier' => Supplier::count(),
        ]);

        return view('page.dashboard', compact(['statistik', 'tanggal', 'chart_1', 'data_bar_pendapatan', 'data_bar_pengeluaran', 'data_bar_pembelian', 'data_bar_penjualan']));
    }
}
