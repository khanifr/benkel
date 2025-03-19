<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PelangganAuthController extends Controller
{
    // Menampilkan halaman login pelanggan
    public function showLogin()
    {
        return view('auth.pelanggan-login');
    }

    // Proses login pelanggan
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            return redirect()->route('pelanggan.profile')->with('success', 'Login berhasil! Selamat datang.');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Menampilkan halaman register pelanggan
    public function showRegister()
    {
        return view('auth.pelanggan-register');
    }

    // Proses registrasi pelanggan
    public function register(Request $request)
    {
        $request->validate([
            'ktp' => 'required|unique:pelanggan',
            'nama' => 'required',
            'alamat' => 'nullable',
            'hp' => 'nullable',
            'email' => 'required|email|unique:pelanggan',
            'password' => 'required|min:6|confirmed',
            'tipe' => 'nullable',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Simpan foto pelanggan jika diunggah
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pelanggan', 'public');
        }

        // Buat pelanggan baru
        $pelanggan = Pelanggan::create([
            'ktp' => $request->ktp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $fotoPath,
        ]);

        // Pastikan pelanggan benar-benar tersimpan sebelum lanjut
        if (!$pelanggan) {
            return back()->with('error', 'Registrasi gagal, coba lagi.');
        }

        // Login otomatis menggunakan guard pelanggan
        Auth::guard('pelanggan')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);


        return redirect()->route('pelanggan.profile')->with('success', 'Registrasi berhasil!');
    }

    // Menampilkan profil pelanggan
    public function showProfile()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        return view('auth.pelanggan-profil', compact('pelanggan'));
    }

    // Logout pelanggan
    public function logout()
    {
        Auth::guard('pelanggan')->logout();
        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}