<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Detailpendaki;

class DetailpendakiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Anggota untuk Pemesanan ID 1
        Detailpendaki::create([
            'pemesanan_id' => 1,
            'pendaki_id'   => 1,  // Pendaki utama / anggota
        ]);

        Detailpendaki::create([
            'pemesanan_id' => 1,
            'pendaki_id'   => 2,
        ]);

        // Anggota untuk Pemesanan ID 2
        Detailpendaki::create([
            'pemesanan_id' => 2,
            'pendaki_id'   => 3,
        ]);

        // Anggota untuk Pemesanan ID 3
        Detailpendaki::create([
            'pemesanan_id' => 3,
            'pendaki_id'   => 2,
        ]);
    }
}
