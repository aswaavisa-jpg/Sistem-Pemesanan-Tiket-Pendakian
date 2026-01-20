<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gunung;

class GunungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gunung::create([
            'nama_gunung'     => 'Gunung Gede',
            'status'          => 'Aktif',
            'jalur_pendakian' => 'Cibodas',
        ]);

        Gunung::create([
            'nama_gunung'     => 'Gunung Pangrango',
            'status'          => 'Aktif',
            'jalur_pendakian' => 'Sukabumi',
        ]);

        Gunung::create([
            'nama_gunung'     => 'Gunung Ciremai',
            'status'          => 'Siaga',
            'jalur_pendakian' => 'Linggarjati',
        ]);

        Gunung::create([
            'nama_gunung'     => 'Gunung Merbabu',
            'status'          => 'Tutup',
            'jalur_pendakian' => 'Selo',
        ]);
    }
}
