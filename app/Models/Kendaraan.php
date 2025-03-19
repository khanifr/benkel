<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $primaryKey = 'nopol';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nopol',
        'merek',
        'tipe',
        'transmisi',
        'kapasitas',
        'tahun',
        'gambar',
        'id_pelanggan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'ktp');
    }
}