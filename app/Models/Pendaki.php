<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaki extends Model
{
    use HasFactory;

    protected $table = 'pendakis';

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'no_hp',
        'alamat'
    ];
    // END PERBAIKAN

    // Relasi Pendaki (1) Membuat Pemesanan (*)
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'pendaki_id', 'id_pendaki');
    }

    // Relasi Pendaki (1) Termasuk Dalam DetailPendaki (*)
    public function detailPendakis()
    {
        return $this->hasMany(Detailpendaki::class, 'pendaki_id', 'id_pendaki');
    }
}