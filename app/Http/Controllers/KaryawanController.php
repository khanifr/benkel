<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view users')) {
            return redirect()->back()->with('error', 'You do not have permission to view the users.');
        }
        $karyawans = Karyawan::all();
        return view('backend.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('backend.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('karyawan', 'public');
        }

        Karyawan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'foto' => $fotoPath
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan created successfully.');
    } // ✅ MENUTUP METHOD store()

    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('backend.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'hp' => 'required|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $karyawan = Karyawan::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto) {
                Storage::disk('public')->delete($karyawan->foto);
            }

            $fotoPath = $request->file('foto')->store('karyawan', 'public');
        } else {
            $fotoPath = $karyawan->foto;
        }

        $karyawan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'foto' => $fotoPath
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan updated successfully.');
    } // ✅ MENUTUP METHOD update()

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        if ($karyawan->foto) {
            Storage::disk('public')->delete($karyawan->foto);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan deleted successfully.');
    } // ✅ MENUTUP METHOD destroy()
}
