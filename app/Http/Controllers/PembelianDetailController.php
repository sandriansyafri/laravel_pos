<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Produk;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function loadFormData($diskon, $total_harga)
    {
        $bayar = $total_harga - ($diskon / 100 * $total_harga);
        $rp_total_bayar = format_idr($total_harga - ($diskon / 100 * $total_harga));
        $rp_total_harga = format_idr($total_harga);
        $terbilang = format_terbilang($total_harga);

        return response()->json([
            'rp_total_bayar' => $rp_total_bayar,
            'rp_total_harga' => $rp_total_harga,
            'total_harga' => $total_harga,
            'bayar' => $bayar,
            'terbilang' => "($terbilang)",
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
        $produk = Produk::find($request->produk_id);
        $detail_pembelian = new DetailPembelian();
        $detail_pembelian->produk_id = $request->produk_id;
        $detail_pembelian->pembelian_id = $request->pembelian_id;
        $detail_pembelian->harga_beli = $produk->harga_beli;
        $detail_pembelian->jumlah = 1;
        $detail_pembelian->subtotal = $produk->harga_beli;
        $detail_pembelian->save();
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

    // PEMBELIAN DETAIL CONTROLLER 
    public function update(Request $request, $id)
    {
        $detail_pembelian = DetailPembelian::find($request->detail_pembelian_id);
        $detail_pembelian->update([
            'jumlah' => $request->qty,
            'subtotal' => $detail_pembelian->harga_beli * $request->qty
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
        $detail_pembelian = DetailPembelian::find($id);
        $detail_pembelian->delete();
    }
}
