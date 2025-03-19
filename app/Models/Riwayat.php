<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $table = 'riwayat'; // Nama tabel

    protected $primaryKey = 'id'; // Primary key sesuai migrasi

    public $incrementing = true; // ID auto-increment

    protected $fillable = [
        'tanggal',
        'keluhan',
        'penanganan',
        'catatan',
        'status', // ENUM ('proses', 'selesai')
        'id_karyawan',
        'nopol',
        'id_jasa',
        'kode_sparepart',
        'ktp_pelanggan'
    ];

    /**
     * Set default value untuk status jika tidak diisi.
     */
    protected $attributes = [
        'status' => 'proses',
    ];

    /**
     * Validasi nilai status agar hanya menerima 'proses' atau 'selesai'.
     */
    public function setStatusAttribute($value)
    {
        $allowedStatuses = ['proses', 'selesai'];
        $this->attributes['status'] = in_array($value, $allowedStatuses) ? $value : 'proses';
    }

    // Relasi ke tabel lain
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function jasaServis()
    {
        return $this->belongsTo(JasaServis::class, 'id_jasa');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'ktp_pelanggan');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'nopol', 'nopol');
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'kode_sparepart', 'kode');
    }
}
