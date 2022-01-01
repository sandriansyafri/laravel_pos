<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validation();
        $request['password'] = Hash::make($request->password);
        User::create($request->all());

        return redirect()->route('login')->with([
            'status' => 'register success',
            'email' => $request->email
        ]);
    }

    public function index()
    {
        return view('auth.register');
    }



    public function user_session()
    {
    }

    private function validation()
    {
        request()->validate([
            'name' => 'required',
            'username' => 'required|min:6|alpha_num',
            'email' => 'required',
            'password' => 'required|confirmed:min:6',
            'password_confirmation' => 'required|same:password',
        ]);
    }
}
