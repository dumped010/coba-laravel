<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // method tampilan login
    public function index()
    {
        return view('login.index', [
            'title' => 'Halaman Login',
            'active' => 'login'

        ]);
    }

    // method menangani autentikasi login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            // validasi email yang ketat, mem filter domain email yang tidak valid
            // untuk belajar, tidak perlu memakai validasi ini
            // 'email' => 'required|email:dns',

            // validasi email sederhana
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // jika data login benar dan ada di database
        if (Auth::attempt($credentials)) {
            // method regenerate() mencegah terjadinya hacking melalui session
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // jika data login salah
        return back()->with('loginError', 'Login failed!');
    }

    // method menangani aksi logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
