<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('backend.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('backend.kendaraan.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nopol' => 'required|string|max:20|unique:kendaraan',
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'transmisi' => 'required|string|max:20',
            'kapasitas' => 'required|integer',
            'tahun' => 'required|integer',
            'id_pelanggan' => 'required|string|max:50|exists:pelanggan,ktp',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('kendaraan', 'public');
            $data['gambar'] = $imagePath;
        }

        Kendaraan::create($data);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan created successfully');
    }

    public function show(Kendaraan $kendaraan)
    {
        return view('backend.kendaraan.show', compact('kendaraan'));
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id); // Gunakan findOrFail untuk menangani data yang tidak ditemukan
        $pelanggans = Pelanggan::all(); // Ambil semua data pelanggan
        return view('backend.kendaraan.edit', compact('kendaraan', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id); // Cari kendaraan berdasarkan ID atau gagal jika tidak ditemukan

        $request->validate([
            'nopol' => 'required|string|max:20|unique:kendaraan,nopol,' . $kendaraan->nopol . ',nopol',
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'transmisi' => 'required|string|max:20',
            'kapasitas' => 'required|integer',
            'tahun' => 'required|integer',
            'id_pelanggan' => 'required|string|max:50|exists:pelanggan,ktp',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kendaraan->gambar) {
                Storage::disk('public')->delete($kendaraan->gambar);
            }

            // Simpan gambar baru
            $imagePath = $request->file('gambar')->store('kendaraan', 'public');
            $data['gambar'] = $imagePath;
        }

        $kendaraan->update($data);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id); // Cari kendaraan berdasarkan ID atau gagal jika tidak ditemukan

        if ($kendaraan->gambar) {
            Storage::disk('public')->delete($kendaraan->gambar);
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus!');
    }

}