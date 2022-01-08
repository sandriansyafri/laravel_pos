<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($penjualan_id)
    {
        return view('page.penjualan.detail.index', compact(['penjualan_id']));
    }

    public function loadFormData($total_harga, $diskon, $bayar)
    {

        $total_bayar = $total_harga - ($diskon / 100 * $total_harga);
        $kembalian = $bayar - $total_bayar;
        $nominal_kembalian = format_terbilang($kembalian);
        return response()->json([
            'ok' => true,
            'rp_total_bayar' => format_idr($total_bayar),
            'rp_total_harga' => format_idr($total_bayar),
            'rp_kembalian' => format_idr($kembalian),
            'total_bayar' => $total_bayar,
            'kembalian' => $kembalian,
            'nominal_kembalian' => $nominal_kembalian
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penjualan_id = $request->penjualan_id;
        $produk_id = $request->produk_id;

        $produk = Produk::find($produk_id);

        $detail_penjualan = new DetailPenjualan();
        $detail_penjualan->penjualan_id = $penjualan_id;
        $detail_penjualan->produk_id = $produk_id;
        $detail_penjualan->harga_jual = $produk->harga_jual;
        $detail_penjualan->jumlah = 1;
        $detail_penjualan->subtotal = $produk->harga_jual;
        $detail_penjualan->save();

        return response()->json([
            'ok' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail_penjualan = DetailPenjualan::find($id);
        $detail_penjualan->update([
            'jumlah' => $request->qty,
            'subtotal' => $detail_penjualan->harga_jual * $request->qty
        ]);

        return response()->json([
            'ok' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail_penjualan = DetailPenjualan::find($id)->delete();
        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }
}
