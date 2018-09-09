<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MyAuth extends Controller
{
    protected $redirectTo = '/';

    public function login(Request $request)
    {
        if(Auth::attempt(['login' => $request->login, 'password' => $request->password]))
        {
            return redirect()->back()->with('logged', 'done');
        }
        return redirect()->back()->with('login', 'error');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('index'))->with('logout', 'logout');
    }
}