<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.pembelian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $supplier = Supplier::firstWhere('id', $id);
        $pembelian = new Pembelian();
        $pembelian->supplier_id = $supplier->id;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;


        $pembelian->save();

        return redirect()->route('pembelian.detail', [
            'supplier_id' => $supplier->id,
            'pembelian_id' => $pembelian->id
        ]);
    }

    public function detail($supplier_id, $pembelian_id)
    {
        return view('page.pembelian.detail', [
            'supplier' => Supplier::find($supplier_id),
            'pembelian' => Pembelian::find($pembelian_id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function update(Request $request, Pembelian $pembelian)
    {
        $pembelian->update([
            'supplier_id' => $request->supplier_id,
            'total_item' => $request->total_item,
            'total_harga' => $request->total_harga,
            'diskon' => $request->diskon,
            'bayar' => $request->bayar,
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
    public function destroy(Pembelian $pembelian)
    {
        $detail_pembelian = DetailPembelian::where('pembelian_id', $pembelian->id)->delete();
        $pembelian->delete();

        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }

    public function deleteAll(Request $request)
    {
        foreach ($request->checklist as $pembelian_id) :
            $detail_pembelian = DetailPembelian::where('pembelian_id', $pembelian_id)->delete();
            $pembelian = Pembelian::find($pembelian_id)->delete();
        endforeach;

        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }
}
