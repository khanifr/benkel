<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PelangganLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.pelanggan-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('pelanggan')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->route('welcome');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::guard('pelanggan')->logout();
        return redirect('/');
    }
}
