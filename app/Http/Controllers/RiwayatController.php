<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Karyawan;
use App\Models\Kendaraan;
use App\Models\JasaServis;
use App\Models\Sparepart;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class RiwayatController extends Controller
{
    // Tampilkan semua data riwayat
    public function store1(Request $request)
    {
         $validated = $request->validate([
            'tanggal' => 'required|date',
            'keluhan' => 'required|string|max:255',
            'penanganan' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:255',
            'id_karyawan' => 'required|exists:karyawan,id',
            'nopol' => 'required|exists:kendaraan,nopol',
            'id_jasa' => 'required|exists:jasa_servis,id',
            'kode_sparepart' => 'nullable|array',
            'kode_sparepart.*' => 'exists:sparepart,kode',
            'jumlah_sparepart' => 'nullable|array',
            'jumlah_sparepart.*' => 'integer|min:1',
            'ktp_pelanggan' => 'required|exists:pelanggan,ktp',
            'status' => 'required|string|max:50',
            'no_urut' => 'required|exists:bookings,no_urut',
        ]);

        DB::beginTransaction();
        try {
            // Simpan riwayat dengan kode_sparepart dan jumlah sebagai JSON
            $sparepartData = [];
            if (!empty($request->kode_sparepart)) {
                foreach ($request->kode_sparepart as $index => $kode) {
                    $sparepartData[] = [
                        'kode' => $kode,
                        'jumlah' => $request->jumlah_sparepart[$index] ?? 1
                    ];
                }
            }
            $validated['kode_sparepart'] = json_encode($sparepartData);

            // Simpan riwayat servis
            $riwayat = Riwayat::create($validated);

            // Kurangi stok untuk setiap sparepart yang dipilih
            if (!empty($request->kode_sparepart)) {
                foreach ($request->kode_sparepart as $index => $kode) {
                    $sparepart = Sparepart::where('kode', $kode)->first();
                    $jumlahDigunakan = $request->jumlah_sparepart[$index] ?? 1;

                    if ($sparepart) {
                        if ($sparepart->jumlah >= $jumlahDigunakan) {
                            $sparepart->decrement('jumlah', $jumlahDigunakan);
                        } else {
                            throw new \Exception("Stok sparepart {$sparepart->nama} tidak mencukupi. Tersisa {$sparepart->jumlah} unit.");
                        }
                    }
                }
            }

            // Hapus booking setelah servis selesai
            $booking = Booking::findOrFail($validated['no_urut']);
            $booking->delete();

            DB::commit();
            return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil ditambahkan dan stok sparepart diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }




    public function index()
    {
        $riwayats = Riwayat::with(['karyawan', 'kendaraan', 'jasaServis', 'sparepart', 'pelanggan'])->get();
        return view('backend.riwayat.index', compact('riwayats'));
    }

    // Form tambah riwayat baru
    // public function create()
    // {
    //     $karyawans = Karyawan::all();
    //     $kendaraans = Kendaraan::all();
    //     $jasaServis = JasaServis::all();
    //     $spareparts = Sparepart::all();
    //     $pelanggans = Pelanggan::all();

    //     return view('backend.riwayat.create', compact('karyawans', 'kendaraans', 'jasaServis', 'spareparts', 'pelanggans'));
    // }

    public function create1($id)
    {
        $booking = Booking::findOrFail($id); // Cari booking berdasarkan ID

        // Data yang tersedia untuk form
        $karyawans = Karyawan::all();
        $kendaraans = Kendaraan::all();
        $jasaServis = JasaServis::all();
        $spareparts = Sparepart::all();
        $pelanggans = Pelanggan::all();

        return view('backend.riwayat.create1', compact('booking', 'karyawans', 'kendaraans', 'jasaServis', 'spareparts', 'pelanggans'));
    }



    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'tanggal' => 'required|date',
    //         'keluhan' => 'required|string|max:255',
    //         'penanganan' => 'nullable|string|max:255',
    //         'catatan' => 'nullable|string|max:255',
    //         'id_karyawan' => 'required|exists:karyawan,id',
    //         'nopol' => 'required|exists:kendaraan,nopol',
    //         'id_jasa' => 'required|exists:jasa_servis,id',
    //         'kode_sparepart' => 'nullable|array',
    //         'kode_sparepart.*' => 'exists:sparepart,kode',
    //         'ktp_pelanggan' => 'required|exists:pelanggan,ktp',
    //         'status' => 'required|string|max:50',
    //     ]);


    //     DB::beginTransaction();
    //     try {
    //         // Simpan riwayat dengan kode_sparepart sebagai JSON
    //         $validated['kode_sparepart'] = json_encode($validated['kode_sparepart'] ?? []);
    //         $riwayat = Riwayat::create($validated);

    //         // Kurangi stok untuk setiap sparepart yang dipilih
    //         if (!empty($request->kode_sparepart)) {
    //             foreach ($request->kode_sparepart as $kode) {
    //                 $sparepart = Sparepart::where('kode', $kode)->first();
    //                 if ($sparepart) {
    //                     if ($sparepart->jumlah > 0) {
    //                         $sparepart->decrement('jumlah');
    //                     } else {
    //                         throw new \Exception("Stok sparepart {$sparepart->nama} tidak mencukupi.");
    //                     }
    //                 }
    //             }
    //         }

    //         // Update status booking
    //         Booking::where('nopol', $request->nopol)->update(['status' => 'Selesai & Diambil']);

    //         DB::commit();
    //         return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil ditambahkan.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->withErrors($e->getMessage());
    //     }

    // }



    // Menampilkan detail riwayat servis
    public function show($id)
    {
        $riwayat = Riwayat::with(['karyawan', 'kendaraan', 'jasaServis', 'sparepart', 'pelanggan'])->findOrFail($id);
        return view('backend.riwayat.view', compact('riwayat'));
    }


    //tombol seelsai
    public function updateStatusToSelesai($id)
    {
        $riwayat = Riwayat::find($id);

        // Pastikan riwayat ditemukan dan statusnya masih 'proses'  
        if ($riwayat && $riwayat->status === 'proses') {
            $riwayat->status = 'selesai';
            $riwayat->save();

            return redirect()->route('riwayat.index')->with('success', 'Status berhasil diubah menjadi selesai.');
        }

        return redirect()->route('riwayat.index')->with('error', 'Status tidak dapat diubah.');
    }



    // Form edit riwayat
    // public function edit($id)
    // {
    //     $riwayat = Riwayat::findOrFail($id);
    //     $karyawans = Karyawan::all();
    //     $kendaraans = Kendaraan::all();
    //     $jasaServis = JasaServis::all();
    //     $spareparts = Sparepart::all();
    //     $pelanggans = Pelanggan::all();

    //     return view('backend.riwayat.edit', compact('riwayat', 'karyawans', 'kendaraans', 'jasaServis', 'spareparts', 'pelanggans'));
    // }

    // Update riwayat yang sudah ada
    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'tanggal' => 'required|date',
    //         'keluhan' => 'required|string|max:255',
    //         'penanganan' => 'nullable|string|max:255',
    //         'catatan' => 'nullable|string|max:255',
    //         'id_karyawan' => 'required|exists:karyawan,id',
    //         'nopol' => 'required|exists:kendaraan,nopol',
    //         'id_jasa' => 'required|exists:jasa_servis,id',
    //         'kode_sparepart' => 'nullable|exists:sparepart,kode',
    //         'ktp_pelanggan' => 'required|exists:pelanggan,ktp',
    //         'status' => 'required|string|max:50',
    //     ]);

    //     $riwayat = Riwayat::findOrFail($id);
    //     $riwayat->update($validated);

    //     return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil diperbarui.');
    // }

    // Hapus riwayat
    public function destroy($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        $riwayat->delete();

        return redirect()->route('riwayat.index')->with('success', 'Riwayat berhasil dihapus.');
    }
}
