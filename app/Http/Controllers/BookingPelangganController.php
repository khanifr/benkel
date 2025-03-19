<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Kendaraan;

class BookingPelangganController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('nik', auth()->user()->ktp)
            ->orderBy('tanggal_booking', 'asc')
            ->get()
            ->map(function ($booking) {
                $booking->status_class = $this->getStatusClass($booking->status);
                return $booking;
            });

        return view('profile_pelanggan.booking.index', compact('bookings'));
    }

    private function getStatusClass($status)
    {
        return match ($status) {
            'menunggu_booking' => 'bg-warning text-dark',
            'proses' => 'bg-success',
            'selesai' => 'bg-secondary',
            default => 'bg-dark',
        };
    }


    public function create($nopol = null)
    {
        // Ambil daftar kendaraan milik pelanggan yang login
        $kendaraans = Kendaraan::where('id_pelanggan', auth()->user()->ktp)->get();
        $kendaraanList = Kendaraan::where('id_pelanggan', auth()->user()->ktp)->get(); // Ambil daftar kendaraan pelanggan

        $selectedKendaraan = null;
        $sudahDibooking = false;

        // Ambil daftar kendaraan yang sedang dibooking oleh pelanggan
        $kendaraanDibooking = Booking::whereIn('nopol', $kendaraanList->pluck('nopol'))
            ->where('status', '!=', 'selesai') // Hanya booking yang belum selesai
            ->pluck('nopol')
            ->toArray();

        if ($nopol) {
            $selectedKendaraan = Kendaraan::where('nopol', $nopol)
                ->where('id_pelanggan', auth()->user()->ktp)
                ->first();

            // Cek apakah kendaraan ini sudah memiliki booking yang belum selesai
            $sudahDibooking = in_array($nopol, $kendaraanDibooking);
        }

        return view('profile_pelanggan.booking.create', compact('kendaraans', 'selectedKendaraan', 'kendaraanList', 'sudahDibooking', 'kendaraanDibooking'));
    }


    public function store(Request $request)
    {
        $request->merge([
            'tanggal_penanganan' => $request->tanggal_penanganan ?: null,
            'jam_booking' => $request->jam_booking ?: null,
        ]);

        $request->validate([
            'tanggal_booking' => 'required|date',
            'tanggal_penanganan' => 'nullable|date',
            'jam_booking' => 'nullable',
            'nopol' => 'required|exists:kendaraan,nopol',
            'keluhan' => 'required|string|max:255',
        ]);

        $kendaraan = Kendaraan::where('nopol', $request->nopol)->first();
        $no_antrian = 0;

        Booking::create([
            'nik' => auth()->user()->ktp,
            'tanggal_booking' => $request->tanggal_booking,
            'tanggal_penanganan' => $request->tanggal_penanganan,
            'jam_booking' => $request->jam_booking,
            'nopol' => $request->nopol,
            'merek' => $kendaraan->merek,
            'tipe' => $kendaraan->tipe,
            'transmisi' => $kendaraan->transmisi,
            'kapasitas' => $kendaraan->kapasitas,
            'tahun' => $kendaraan->tahun,
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu',
            'no_antrian_per_hari' => $no_antrian,
        ]);

        return redirect()->route('booking.pelanggan.index')->with('success', 'Booking berhasil dibuat!');
    }


    public function destroy($id)
    {
        $booking = Booking::where('nik', auth()->user()->ktp)->where('no_urut', $id)->firstOrFail();
        $booking->delete();
        return redirect()->route('booking.pelanggan.index')->with('success', 'Berhasil Cancel Booking!.');
    }
}
