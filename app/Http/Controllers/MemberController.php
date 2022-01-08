<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('page.member.index');
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
            'nama_member' => 'required',
        ]);

        $request['kode_member'] = Str::random(13);
        $data = Member::create($request->all());
        return response()->json([
            'ok' => true,
            'message' => 'created',
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return response()->json([
            'member' => $member
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
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama_member' => 'required'
        ]);

        try {
            $request['kode_member'] = Str::random(13);
            $member->update($request->all());
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
    public function destroy(Member $member)
    {
        $member->delete();
        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }

    public function deleteAll(Request $request)
    {
        foreach ($request['checklist'] as $id) :
            Member::find($id)->delete();
        endforeach;

        return response()->json([
            'ok' => 'true',
            'message' => 'deleted'
        ]);
    }
}
