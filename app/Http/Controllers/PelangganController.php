<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('backend.pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('backend.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ktp' => 'required|string|max:50',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string|max:15',
            'email' => 'required|email|max:100',
            'password' => 'required|min:6',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $data = $request->except('password', 'foto_profile');
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pelanggan', $filename); // Simpan di storage/app/public/pelanggan
            $data['foto_profile'] = $filename; // Simpan nama file saja
        }

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('backend.pelanggan.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('backend.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $ktp)
    {
        $pelanggan = Pelanggan::where('ktp', $ktp)->firstOrFail();

        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string|max:15',
            'email' => 'required|email|max:100|unique:pelanggan,email,' . $pelanggan->ktp . ',ktp',
            'password' => 'nullable|min:6',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['password', 'foto_profile']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profile')) {
            // Hapus foto lama jika ada
            if ($pelanggan->foto_profile) {
                Storage::disk('public')->delete('pelanggan/' . $pelanggan->foto_profile);
            }

            $file = $request->file('foto_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/pelanggan', $filename);
            $data['foto_profile'] = $filename;
        }

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->foto_profile) {
            Storage::disk('public')->delete('pelanggan/' . $pelanggan->foto_profile);
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
