<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PelangganKendaraanController extends Controller
{
    // Tampilkan form tambah kendaraan
    public function create()
    {
        return view('profile_pelanggan.kendaraan.create');
    }

    // Simpan kendaraan baru
    public function store(Request $request)
    {
        $request->validate([
            'nopol' => 'required|string|max:20|unique:kendaraan,nopol',
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'transmisi' => 'required|string|in:manual,matic',
            'kapasitas' => 'required|integer|min:50|max:10000',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pelanggan = Auth::guard('pelanggan')->user();

        if (!$pelanggan) {
            return back()->with('error', 'Pelanggan tidak ditemukan atau belum login.');
        }

        $kendaraan = new Kendaraan();
        $kendaraan->nopol = $request->nopol;
        $kendaraan->merek = $request->merek;
        $kendaraan->tipe = $request->tipe;
        $kendaraan->transmisi = $request->transmisi;
        $kendaraan->kapasitas = $request->kapasitas;
        $kendaraan->tahun = $request->tahun;
        // Set id_pelanggan sesuai dengan ID (misalnya KTP) pelanggan yang sedang login
        $kendaraan->id_pelanggan = $pelanggan->ktp;

        if ($request->hasFile('gambar')) {
            $kendaraan->gambar = $request->file('gambar')->store('kendaraan', 'public');
        }

        $kendaraan->save();

        return redirect()->route('pelanggan.profile')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function edit($nopol)
    {
        // Pastikan pelanggan sudah login
        $pelanggan = Auth::guard('pelanggan')->user();
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Pelanggan tidak ditemukan atau belum login.');
        }

        // Ambil KTP sebagai identifier pelanggan
        $ktp = strval($pelanggan->ktp);

        // Cari kendaraan berdasarkan nopol dan pastikan kendaraan tersebut milik pelanggan yang login
        $kendaraan = Kendaraan::where('nopol', $nopol)
            ->where('id_pelanggan', $ktp)
            ->first();

        if (!$kendaraan) {
            return redirect()->back()->with('error', 'Kendaraan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Tampilkan view form edit dengan data kendaraan, pastikan nama view sesuai dengan file yang ada
        return view('profile_pelanggan.kendaraan.edit_kendaraan', compact('kendaraan'));
    }

    public function update(Request $request, $nopol)
    {
        // Pastikan pelanggan sudah login
        $pelanggan = Auth::guard('pelanggan')->user();
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Pelanggan tidak ditemukan atau belum login.');
        }

        $ktp = strval($pelanggan->ktp);

        // Cari kendaraan berdasarkan nopol dan pastikan kendaraan tersebut milik pelanggan yang login
        $kendaraan = Kendaraan::where('nopol', $nopol)
            ->where('id_pelanggan', $ktp)
            ->first();

        if (!$kendaraan) {
            return redirect()->back()->with('error', 'Kendaraan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Validasi data input
        $request->validate([
            'nopol' => 'required|string|max:20',
            'merek' => 'required|string|max:50',
            'tipe' => 'required|string|max:50',
            'transmisi' => 'required|string|in:manual,matic',
            'kapasitas' => 'required|integer|min:50|max:10000',
            'tahun' => 'required|integer|min:1900|max:' . date('Y'),
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Perbarui data kendaraan
        $kendaraan->nopol = $request->nopol;
        $kendaraan->merek = $request->merek;
        $kendaraan->tipe = $request->tipe;
        $kendaraan->transmisi = $request->transmisi;
        $kendaraan->kapasitas = $request->kapasitas;
        $kendaraan->tahun = $request->tahun;

        if ($request->hasFile('gambar')) {
            $kendaraan->gambar = $request->file('gambar')->store('kendaraan', 'public');
        }

        $kendaraan->save();

        return redirect()->route('pelanggan.profile')->with('success', 'Kendaraan berhasil diperbarui!');
    }

    public function delete($nopol)
    {
        // Pastikan pelanggan sudah login
        $pelanggan = Auth::guard('pelanggan')->user();
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Pelanggan tidak ditemukan atau belum login.');
        }

        // Ambil KTP sebagai identifier pelanggan
        $ktp = strval($pelanggan->ktp);

        // Cari kendaraan berdasarkan nopol dan pastikan kendaraan tersebut milik pelanggan yang login
        $kendaraan = Kendaraan::where('nopol', $nopol)
            ->where('id_pelanggan', $ktp)
            ->first();

        if (!$kendaraan) {
            return redirect()->back()->with('error', 'Kendaraan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Hapus file gambar kendaraan jika ada
        if ($kendaraan->gambar) {
            Storage::disk('public')->delete($kendaraan->gambar);
        }

        // Hapus data kendaraan
        $kendaraan->delete();

        return redirect()->route('pelanggan.profile')->with('success', 'Kendaraan berhasil dihapus!');
    }

}
