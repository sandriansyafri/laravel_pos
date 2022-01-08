<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('page.kategori.index');
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
            'nama_kategori' => 'required'
        ]);

        try {
            $data = Kategori::create($request->only('nama_kategori'));
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
    public function show(Kategori $kategori)
    {
        return response()->json([
            'kategori' => $kategori
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
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        try {
            $kategori->update($request->only('nama_kategori'));
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
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }

    public function deleteAll(Request $request)
    {
        foreach ($request['checklist'] as $id) :
            Kategori::find($id)->delete();
        endforeach;

        return response()->json([
            'ok' => 'true',
            'message' => 'deleted'
        ]);
    }
}
