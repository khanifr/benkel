<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register'); // Pastikan file ini ada di resources/views/auth/register.blade.php
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ktp' => ['required', 'string', 'max:50', 'unique:pelanggan,ktp'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'hp' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:pelanggan,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_profile' => ['nullable', 'image', 'max:2048'],
        ]);

        // Upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto_profile')) {
            $fotoPath = $request->file('foto_profile')->store('profile_pictures', 'public');
        }

        // Simpan data pelanggan
        $pelanggan = Pelanggan::create([
            'ktp' => $request->ktp,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto_profile' => $fotoPath,
        ]);

        event(new Registered($pelanggan));

        Auth::login($pelanggan);

        return redirect()->route('pelanggan.dashboard');
    }
}
