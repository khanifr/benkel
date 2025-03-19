<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\JasaServis; // Sesuaikan dengan model baru
use App\Models\Sparepart;

class RiwayatPelangganController extends Controller
{
    /**
     * Menampilkan daftar riwayat servis pelanggan yang sedang login.
     */
    public function index()
    {
        // Ambil data riwayat servis pelanggan yang sedang login
        $riwayats = Riwayat::where('ktp_pelanggan', auth()->user()->ktp)
            ->with(['kendaraan', 'pelanggan', 'jasaServis', 'sparepart']) // Menggunakan jasaServis
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('profile_pelanggan.riwayat.riwayatfront', compact('riwayats'));
    }

    /**
     * Mengambil data riwayat servis spesifik untuk modal invoice.
     */
    public function show($id)
    {
        $riwayat = Riwayat::with(['kendaraan', 'pelanggan', 'jasaServis', 'sparepart', 'karyawan']) // Menggunakan jasaServis
            ->findOrFail($id);

        return response()->json($riwayat);
    }
}
