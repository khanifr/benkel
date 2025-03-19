<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'no_urut'; // Ubah primary key ke 'no_urut'
    public $incrementing = true; // Karena 'id' biasanya auto-increment
    public $timestamps = true;

    protected $fillable = [
        'nik',
        'tanggal_booking',
        'tanggal_penanganan',
        'jam_booking',
        'no_antrian_per_hari',
        'keluhan',
        'nopol',
        'merek',
        'tipe',
        'transmisi',
        'kapasitas',
        'tahun',
        'status', //'Menunggu','Dibatalkan','Dikonfirmasi','Menunggu Sparepart','Dalam Antrian','Sedang Dikerjakan','Siap Diambil','Selesai & Diambil'
    ];

    // ✅ Relasi ke model Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'nik', 'ktp');
    }

    // ✅ Accessor untuk menampilkan jam_booking dalam format 08:00
    // public function getJamBookingAttribute($value)
    // {
    //     return sprintf('%02d:00', $value); 
    // }
}
