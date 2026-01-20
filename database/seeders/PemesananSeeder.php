<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemesanan::create([
            'pendaki_id'           => 1,
            'gunung_id'            => 1,
            'jadwal_pendakian_id'  => 1,
            'jumlah_anggota'       => 3,
        ]);

        Pemesanan::create([
            'pendaki_id'           => 2,
            'gunung_id'            => 1,
            'jadwal_pendakian_id'  => 2,
            'jumlah_anggota'       => 4,
        ]);

        Pemesanan::create([
            'pendaki_id'           => 3,
            'gunung_id'            => 2,
            'jadwal_pendakian_id'  => 2,
            'jumlah_anggota'       => 2,
        ]);
    }
}
