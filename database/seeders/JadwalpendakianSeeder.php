<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPendakian;

class JadwalPendakianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalPendakian::create([
            'gunung_id'      => 1,
            'tanggal_naik'   => '2025-06-01',
            'tanggal_turun'  => '2025-06-03',
        ]);

        JadwalPendakian::create([
            'gunung_id'      => 1,
            'tanggal_naik'   => '2025-06-10',
            'tanggal_turun'  => '2025-06-12',
        ]);

        JadwalPendakian::create([
            'gunung_id'      => 2,
            'tanggal_naik'   => '2025-07-05',
            'tanggal_turun'  => '2025-07-07',
        ]);
    }
}
