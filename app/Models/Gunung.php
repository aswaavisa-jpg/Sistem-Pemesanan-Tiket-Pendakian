<?php

namespace App\Models;

use App\Http\Controllers\JadwalpendakianController;
use Database\Seeders\JadwalpendakianSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gunung extends Model
{
    use HasFactory;

    protected $table = 'gunungs';

    protected $fillable = [
        'nama_gunung',
        'status',
        'jalur_pendakian',
    ];

    // Relasi Gunung (1) Memiliki JadwalPendakian (*)
    public function jadwalPendakians()
    {
        return $this->hasMany(JadwalPendakian::class, 'gunung_id', 'id_gunung');
    }

    // Relasi Gunung (1) Digunakan oleh Pemesanan (*)
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'id_gunung', 'id_gunung');
    }
}