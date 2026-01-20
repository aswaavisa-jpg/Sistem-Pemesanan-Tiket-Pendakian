<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualantiket extends Model
{
    protected $table = 'penjualantikets';

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'jumlah_anggota',
    ];
}