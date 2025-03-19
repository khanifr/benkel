<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Booking;
use App\Models\Kendaraan;
use App\Models\Riwayat;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalKaryawan = Karyawan::count();
        $totalBooking = Booking::count();
        $totalKendaraan = Kendaraan::count();
        $totalRiwayat = riwayat::count();
        return view('dashboard', compact('totalPelanggan', 'totalBooking', 'totalKendaraan', 'totalRiwayat'));
    }
}
