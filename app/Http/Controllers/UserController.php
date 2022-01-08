<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('page.user.index');
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

    private function validation()
    {
        request()->validate([
            'name' => 'required',
            'username' => 'required|min:6|alpha_num',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required|confirmed:min:6',
            'password_confirmation' => 'required|same:password',
        ]);
    }

    public function store(Request $request)
    {
        $this->validation();
        $request['password'] = Hash::make($request->password);
        try {
            $data = User::create($request->all());
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
    public function show(User $user)
    {
        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('page.user.edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'current_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required|same:new_password',
        ];

        $request->validate($data);

        if ($user->email === $request->email) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'role' => $request->role,
                    'name' => $request->name,
                    'username' => $request->username,
                    'password' => Hash::make($request->new_password),
                ]);
                return back()->with('status_success', 'ok');
            } else {
                return back()->with('status_fail', 'something wrong with password!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'ok' => true,
            'message' => 'deleted'
        ]);
    }

    public function deleteAll(Request $request)
    {
        foreach ($request['checklist'] as $id) :
            User::find($id)->delete();
        endforeach;

        return response()->json([
            'ok' => 'true',
            'message' => 'deleted'
        ]);
    }
}
