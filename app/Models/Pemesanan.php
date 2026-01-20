<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pendaki',
        'jalur_pendakian',
        'tgl_naik',
        'tgl_turun',
        'jumlah_anggota',
    ];
}
