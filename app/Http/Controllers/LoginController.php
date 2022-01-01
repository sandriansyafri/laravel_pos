<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->with([
            'status' => 'Email / Password is wrong!',
        ]);
    }

    public function validation()
    {
        return request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    public function index()
    {
        return view('auth.login');
    }
}
