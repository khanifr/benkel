<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->query('tanggal', now()->toDateString());
        // Tampilkan booking aktif pada tanggal tertentu, diurutkan berdasarkan nomor antrian
        $bookings = Booking::whereDate('tanggal_booking', $tanggal)
            ->orderBy('no_antrian_per_hari', 'asc')
            ->get();
        $pelanggans = Pelanggan::all();

        return view('backend.booking.index', compact('bookings', 'pelanggans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $kendaraans = Kendaraan::all();

        $antrian_terpakai = Booking::whereDate('tanggal_booking', now()->toDateString())
            ->pluck('no_antrian_per_hari')
            ->map(fn($item) => (string) $item)
            ->toArray();

        return view('backend.booking.create', compact('pelanggans', 'kendaraans', 'antrian_terpakai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:pelanggan,ktp',
            'tanggal_booking' => 'required|date',
            'jam_booking' => 'nullable|string|max:20',
            'tanggal_penanganan' => 'nullable|date',
            'keluhan' => 'nullable|string|max:255',
            'nopol' => 'required|string|max:20',
            'merek' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'transmisi' => 'required|string|max:50',
            'kapasitas' => 'required|integer',
            'tahun' => 'required|digits:4',
            'status' => 'required|in:Menunggu,Dibatalkan,Dikonfirmasi,Menunggu Sparepart,Dalam Antrian,Sedang Dikerjakan,Siap Diambil,Selesai & Diambil',
        ]);

        // Cek apakah slot booking sudah penuh pada tanggal & jam yang sama
        $tanggal_booking = $request->tanggal_booking;
        $jam_booking = $request->jam_booking;

        $existingBooking = Booking::whereDate('tanggal_booking', $tanggal_booking)
            ->where('jam_booking', $jam_booking)
            ->exists();

        if ($existingBooking) {
            return redirect()->back()->withErrors(['jam_booking' => 'Jam ini sudah dibooking! Silakan pilih jam lain.']);
        }

        // Ambil nomor antrian tertinggi untuk tanggal yang sama
        $lastAntrian = Booking::whereDate('tanggal_booking', $tanggal_booking)
            ->max('no_antrian_per_hari');

        $no_antrian_per_hari = $lastAntrian ? $lastAntrian + 1 : 1;

        Booking::create([
            'nik' => $request->nik,
            'tanggal_booking' => $tanggal_booking,
            'jam_booking' => $jam_booking,
            'tanggal_penanganan' => $request->tanggal_penanganan,
            'keluhan' => $request->keluhan,
            'nopol' => $request->nopol,
            'merek' => $request->merek,
            'tipe' => $request->tipe,
            'transmisi' => $request->transmisi,
            'kapasitas' => $request->kapasitas,
            'tahun' => $request->tahun,
            'status' => $request->status,
            'no_antrian_per_hari' => $no_antrian_per_hari
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan!');
    }

    // Method untuk admin mengonfirmasi booking (misalnya oleh Gilang)
    public function confirmBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Dikonfirmasi';
        // Catat waktu konfirmasi untuk keperluan pengecekan batas 1 jam
        $booking->confirmation_time = Carbon::now();
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Booking dikonfirmasi!');
    }

    // Method untuk admin memasukkan tanggal dan jam penanganan saat pelanggan datang ke bengkel
    public function setPenanganan(Request $request, $id)
    {
        $request->validate([
            'tanggal_penanganan' => 'required|date',
            'jam_penanganan' => 'required|string|max:20',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->tanggal_penanganan = $request->tanggal_penanganan;
        $booking->jam_penanganan = $request->jam_penanganan; // Asumsikan field ini ada di tabel booking
        // Ubah status menjadi "Siap Diambil" setelah perbaikan selesai
        $booking->status = 'Siap Diambil';
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Data penanganan telah diinput dan status diubah ke Siap Diambil.');
    }

    // Method untuk menyelesaikan booking ketika pelanggan mengambil kendaraannya
    // public function finishBooking($id)
    // {
    //     $booking = Booking::findOrFail($id);
    //     $booking->status = 'Sudah Diambil & Selesai';
    //     $booking->save();

    //     // Pindahkan data booking ke tabel riwayat
    //     Riwayat::create([
    //         'nik' => $booking->nik,
    //         'tanggal_booking' => $booking->tanggal_booking,
    //         'jam_booking' => $booking->jam_booking,
    //         'tanggal_penanganan' => $booking->tanggal_penanganan,
    //         'jam_penanganan' => $booking->jam_penanganan, // jika ada
    //         'keluhan' => $booking->keluhan,
    //         'nopol' => $booking->nopol,
    //         'merek' => $booking->merek,
    //         'tipe' => $booking->tipe,
    //         'transmisi' => $booking->transmisi,
    //         'kapasitas' => $booking->kapasitas,
    //         'tahun' => $booking->tahun,
    //         'status' => $booking->status,
    //         'no_antrian_per_hari' => $booking->no_antrian_per_hari,
    //     ]);

    //     // Simpan tanggal booking untuk reordering
    //     $tanggal_booking = $booking->tanggal_booking;
    //     // Hapus booking yang sudah selesai
    //     $booking->delete();

    //     // Reorder nomor antrian untuk booking yang tersisa di tanggal tersebut
    //     $this->reorderAntrian($tanggal_booking);

    //     return redirect()->route('booking.index')->with('success', 'Booking selesai dan telah dipindahkan ke riwayat.');
    // }


    //hapus data booking setelah mengirim data booking ke table riwayat
    // public function createHistory($id)
    // {
    //     // 1. Ambil data booking berdasarkan ID
    //     $booking = Booking::findOrFail($id);

    //     // 2. Pindahkan data booking ke tabel riwayat
    //     Riwayat::create([
    //         'nik' => $booking->nik,
    //         'tanggal_booking' => $booking->tanggal_booking,
    //         'jam_booking' => $booking->jam_booking,
    //         'tanggal_penanganan' => $booking->tanggal_penanganan,
    //         'jam_penanganan' => $booking->jam_penanganan, // pastikan field ini ada di tabel riwayat
    //         'keluhan' => $booking->keluhan,
    //         'nopol' => $booking->nopol,
    //         'merek' => $booking->merek,
    //         'tipe' => $booking->tipe,
    //         'transmisi' => $booking->transmisi,
    //         'kapasitas' => $booking->kapasitas,
    //         'tahun' => $booking->tahun,
    //         'status' => $booking->status,
    //         'no_antrian_per_hari' => $booking->no_antrian_per_hari,
    //     ]);

    //     // 3. Simpan tanggal booking untuk keperluan reordering
    //     $tanggal_booking = $booking->tanggal_booking;

    //     // 4. Hapus data booking aktif yang sudah dipindahkan ke riwayat
    //     $booking->delete();

    //     // 5. Lakukan reordering nomor antrian (jika dibutuhkan)
    //     $this->reorderAntrian($tanggal_booking);

    //     return redirect()->route('booking.index')
    //         ->with('success', 'Riwayat berhasil dibuat dan booking dihapus.');
    // }





    // Fungsi private untuk mereset ulang nomor antrian setelah penghapusan booking
    private function reorderAntrian($tanggal_booking)
    {
        $bookings = Booking::whereDate('tanggal_booking', $tanggal_booking)
            ->orderBy('no_antrian_per_hari', 'asc')
            ->get();

        $no = 1;
        foreach ($bookings as $booking) {
            $booking->update(['no_antrian_per_hari' => $no]);
            $no++;
        }
    }


    //saat mengubah status akan mempengaruhi nomor antrian
    public function updateStatus($id, $status)
    {
        $booking = Booking::findOrFail($id);

        if ($status === 'Dikonfirmasi') {
            if (!$booking->no_antrian_per_hari) {
                $lastAntrian = Booking::whereDate('tanggal_booking', $booking->tanggal_booking)
                    ->where('status', 'Dikonfirmasi')
                    ->orderBy('no_antrian_per_hari', 'desc')
                    ->first();

                $no_antrian_per_hari = $lastAntrian ? $lastAntrian->no_antrian_per_hari + 1 : 1;
                $booking->no_antrian_per_hari = $no_antrian_per_hari;
            }
        } elseif ($status === 'Dibatalkan' || $status === 'Siap Diambil') {
            $oldAntrian = $booking->no_antrian_per_hari;
            $booking->no_antrian_per_hari = null;
            $booking->save();

            Booking::whereDate('tanggal_booking', $booking->tanggal_booking)
                ->where('status', 'Dikonfirmasi')
                ->where('no_antrian_per_hari', '>', $oldAntrian)
                ->orderBy('no_antrian_per_hari')
                ->get()
                ->each(function ($b) {
                    $b->no_antrian_per_hari -= 1;
                    $b->save();
                });
        }

        $booking->status = $status;
        $booking->save();

        return response()->json(['success' => 'Status berhasil diperbarui!']);
    }



    public function checkAvailability(Request $request)
    {
        $tanggal_booking = $request->query('tanggal_booking');
        $jam_booking = $request->query('jam_booking');

        $exists = Booking::whereDate('tanggal_booking', $tanggal_booking)
            ->where('jam_booking', $jam_booking)
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function cekJadwal(Request $request)
    {
        $tanggal_booking = $request->query('tanggal_booking');
        $jam_booking = date('H:i', strtotime($tanggal_booking));

        $isTaken = Booking::whereDate('tanggal_booking', date('Y-m-d', strtotime($tanggal_booking)))
            ->whereTime('tanggal_booking', '=', $jam_booking)
            ->exists();

        return response()->json(['available' => !$isTaken]);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        return view('backend.booking.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $pelanggans = Pelanggan::all();
        return view('backend.booking.edit', compact('booking', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_booking' => 'required|date',
            'tanggal_penanganan' => 'nullable|date',
            'jam_booking' => [
                'nullable',
                // Validasi format misal "12:00 - 13:00"
                'regex:/^([0-9]{1,2}:[0-9]{2})\s*-\s*([0-9]{1,2}:[0-9]{2})$/'
            ],
            'status' => 'required|in:Menunggu,Dibatalkan,Dikonfirmasi,Menunggu Sparepart,Dalam Antrian,Sedang Dikerjakan,Siap Diambil,Selesai & Diambil',
        ], [
            'jam_booking.regex' => 'Format jam tidak valid. Pastikan formatnya "HH:MM - HH:MM".'
        ]);

        $data = [
            'tanggal_booking' => $request->tanggal_booking,
            'tanggal_penanganan' => $request->tanggal_penanganan,
            'jam_booking' => $request->jam_booking,
            'status' => $request->status,
        ];

        $booking = Booking::findOrFail($id);
        $booking->update($data);

        // Jika status berubah menjadi "Dikonfirmasi", update ulang nomor antrian (jika diperlukan)
        // if ($request->status === 'Dikonfirmasi') {
        //     $lastAntrian = Booking::whereDate('tanggal_booking', $request->tanggal_booking)
        //         ->where('status', 'Dikonfirmasi')
        //         ->orderBy('no_antrian_per_hari', 'desc')
        //         ->first();

        //     $no_antrian_per_hari = $lastAntrian ? $lastAntrian->no_antrian_per_hari + 1 : 1;
        //     $booking->update(['no_antrian_per_hari' => $no_antrian_per_hari]);
        // }

        return redirect()->route('booking.index')->with('success', 'Booking berhasil diperbarui!');
    }

    public function getAntrianByJam(Request $request)
    {
        $tanggal_booking = $request->query('tanggal_booking');
        $jam_booking = $request->query('jam_booking');

        if (!$tanggal_booking || !$jam_booking) {
            return response()->json(['error' => 'Tanggal dan Jam Booking diperlukan'], 400);
        }

        $booking = Booking::whereDate('tanggal_booking', $tanggal_booking)
            ->where('jam_booking', $jam_booking)
            ->first();

        if ($booking) {
            return response()->json(['no_antrian_per_hari' => $booking->no_antrian_per_hari]);
        } else {
            return response()->json(['no_antrian_per_hari' => null]);
        }
    }

    public function getKendaraanByPelanggan(Request $request)
    {
        $id_pelanggan = $request->query('id_pelanggan');

        if (!$id_pelanggan) {
            return response()->json(['error' => 'ID Pelanggan tidak ditemukan'], 400);
        }

        return response()->json(Kendaraan::where('id_pelanggan', $id_pelanggan)->get());
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $tanggal_booking = $booking->tanggal_booking;
        $booking->delete();
        $this->reorderAntrian($tanggal_booking);
        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
    }
}
