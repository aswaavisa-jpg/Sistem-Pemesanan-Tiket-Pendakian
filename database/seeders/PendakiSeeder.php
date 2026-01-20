<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaki;

class PendakiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pendaki::create([
            'nama'          => 'Avisa Aswa',
            'nik'           => '3210019987654321',
            'jenis_kelamin' => 'Perempuan',
            'no_hp'         => '081234567890',
            'alamat'        => 'Bandung, Jawa Barat',
        ]);

        Pendaki::create([
            'nama'          => 'Raka Pratama',
            'nik'           => '3210028876543210',
            'jenis_kelamin' => 'Laki-laki',
            'no_hp'         => '089512345678',
            'alamat'        => 'Jakarta Selatan',
        ]);

        Pendaki::create([
            'nama'          => 'Dewi Anggraini',
            'nik'           => '3210037765432109',
            'jenis_kelamin' => 'Perempuan',
            'no_hp'         => '082134567821',
            'alamat'        => 'Yogyakarta',
        ]);
    }
}
