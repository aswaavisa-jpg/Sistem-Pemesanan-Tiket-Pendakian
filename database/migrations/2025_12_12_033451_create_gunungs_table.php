<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gunungs', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama_gunung');
            $table->string('status'); // Contoh: 'Aktif', 'Tutup', 'Siaga'
            $table->string('jalur_pendakian');
            $table->timestamps();
        });
    }
    // ... down method
};