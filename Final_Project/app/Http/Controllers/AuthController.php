<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {}
    public function indexlogin()
    {

        return view('auth.login');
    }
    public function store(Request $request)
    {
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($infologin, $remember)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->intended('/');
            } else {
                return redirect()->back()->with('error', 'Email atau Password Tidak Terdaftar');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }
    }
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        return redirect('');
    }
}
