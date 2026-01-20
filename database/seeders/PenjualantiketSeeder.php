<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penjualantiket;

class PenjualantiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penjualantiket::create([
            'nik'            => 3210019987654321,
            'nama'           => 'Avisa Aswa',
            'jenis_kelamin'  => 'P',
            'alamat'         => 'Bandung, Jawa Barat',
            'no_hp'          => 81234567890,
            'jumlah_anggota' => 3,
        ]);

        Penjualantiket::create([
            'nik'            => 3210028876543210,
            'nama'           => 'Raka Pratama',
            'jenis_kelamin'  => 'L',
            'alamat'         => 'Jakarta Selatan',
            'no_hp'          => 89512345678,
            'jumlah_anggota' => 2,
        ]);

        Penjualantiket::create([
            'nik'            => 3210037765432109,
            'nama'           => 'Dewi Anggraini',
            'jenis_kelamin'  => 'P',
            'alamat'         => 'Yogyakarta',
            'no_hp'          => 82134567821,
            'jumlah_anggota' => 4,
        ]);
    }
}
