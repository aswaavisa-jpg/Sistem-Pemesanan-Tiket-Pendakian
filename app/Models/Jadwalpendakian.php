<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPendakian extends Model
{
    use HasFactory;

    protected $fillable = [
        'gunung_id',
        'tanggal_naik',
        'tanggal_turun',
    ];
    // Relasi JadwalPendakian (1) Milik Gunung (1)
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'gunung_id', 'id_gunung');
    }

    // Relasi JadwalPendakian (1) Digunakan oleh Pemesanan (*)
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'jadwal_id', 'id_jadwal');
    }
}