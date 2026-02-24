<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanTiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penjualan_tiket')->insert([
            [
                'kode_tiket'        => 'MBB-001',
                'nama_pendaki'      => 'Avisa',
                'tanggal_pendakian' => '2025-02-10',
                'jumlah_tiket'      => 2,
                'total_harga'       => 100000,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'kode_tiket'        => 'MBB-002',
                'nama_pendaki'      => 'Budi Santoso',
                'tanggal_pendakian' => '2025-02-12',
                'jumlah_tiket'      => 1,
                'total_harga'       => 50000,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}
