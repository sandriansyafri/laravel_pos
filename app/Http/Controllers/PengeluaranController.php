<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('page.pengeluaran.index');
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
        $request->validate([
            'deskripsi' => 'required',
            'nominal' => 'required'
        ]);

        try {
            $data = Pengeluaran::create($request->all());
            return response()->json([
                'ok' => true,
                'message' => 'created',
                'data' => $data
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'ok' => false,
            ], Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengeluaran $pengeluaran)
    {
        return response()->json([
            'pengeluaran' => $pengeluaran
        ]);
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
    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'deskripsi' => 'required',
            'nominal' => 'required'
        ]);

        try {
            $pengeluaran->update($request->all());
            return response()->json([
                'ok' => true,
                'message' => 'updated',
            ], Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'ok' => false,
            ], Response::HTTP_UNAVAILABLE_FOR_LEGAL_REASONS);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }

    public function deleteAll(Request $request)
    {
        foreach ($request['checklist'] as $id) :
            Pengeluaran::find($id)->delete();
        endforeach;

        return response()->json([
            'ok' => 'true',
            'message' => 'deleted'
        ]);
    }
}
