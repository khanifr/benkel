<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Pelanggan extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'ktp'; // Gunakan 'ktp' sebagai primary key
    public $incrementing = false; // Karena 'ktp' bukan auto-increment
    protected $keyType = 'string'; // Jika 'ktp' adalah string


    protected $fillable = [
        'ktp',
        'nama',
        'alamat',
        'hp',
        'email',
        'password',
        'foto_profile'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Di model Pelanggan atau User
    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'pelanggan_id', 'id');
    }

}
