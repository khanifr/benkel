<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;
use App\Models\Riwayat;


class ProfilePelangganController extends Controller
{
    public function profile()
    {
        $pelanggan = auth()->user();
        $kendaraans = Kendaraan::where('id_pelanggan', $pelanggan->ktp)->get();

        // Tambahkan informasi apakah kendaraan memiliki booking aktif
        $kendaraans = $kendaraans->map(function ($kendaraan) {
            $kendaraan->sudahDibooking = Booking::where('nopol', $kendaraan->nopol)
                ->where('status', '!=', 'selesai') // Booking yang masih aktif
                ->exists();
            return $kendaraan;
        });

        // Ambil data riwayat servis berdasarkan pelanggan
        $riwayats = Riwayat::where('ktp_pelanggan', $pelanggan->ktp)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('profile_pelanggan.index', compact('pelanggan', 'kendaraans', 'riwayats'));
    }



    public function editProfile()
    {
        $pelanggan = auth()->user();
        return view('profile_pelanggan.edit', compact('pelanggan'));
    }

    public function updateProfile(Request $request)
    {
        $pelanggan = auth()->user();

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

        return redirect()->route('pelanggan.profile')->with('success', 'Profil berhasil diperbarui!');
    }
    // end profile pelanggan

    public function getRiwayat($id)
    {
        $riwayat = Riwayat::with(['kendaraan', 'jasaServis', 'sparepart'])
            ->where('id', $id)
            ->first();

        if (!$riwayat) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'tanggal' => $riwayat->tanggal,
            'kendaraan' => [
                'merk' => $riwayat->kendaraan->merk ?? 'Tidak Diketahui',
                'plat_nomor' => $riwayat->kendaraan->nopol ?? 'Tidak Diketahui'
            ],
            'jasa' => [
                'nama_jasa' => $riwayat->jasaServis->jenis ?? 'Tidak Diketahui'
            ],
            'sparepart' => [
                'nama_sparepart' => $riwayat->sparepart->nama ?? 'Tidak Ada'
            ],
            'total_biaya' => $riwayat->total_biaya
        ]);
    }

}