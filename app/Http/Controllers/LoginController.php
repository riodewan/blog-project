<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('hello.login1');
    }

    public function authanticate(Request $request)
    {

        $login = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($login)) {
            $request->session()->regenerate();

            return redirect()->intended('/blog');
        }

        return back()->with('loginError', 'Login gagal! Silahkan coba lagi');
    }

    public function logout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
 
        return redirect('/login');
    }
}