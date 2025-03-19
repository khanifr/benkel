<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model {
    use HasFactory;

    protected $primaryKey = 'id_laporan';
    public $incrementing = true;

    protected $fillable = ['nama_laporan', 'status_laporan', 'jumlah_layanan', 'omset', 'stok_sparepart'];
}
