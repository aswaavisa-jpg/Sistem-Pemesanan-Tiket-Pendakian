<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('pendaki_id')->constrained(); // Foreign Key
            $table->foreignId('gunung_id')->constrained(); // Foreign Key
            $table->foreignId('jadwal_pendakian_id')->constrained('jadwal_pendakians'); // Foreign Key
            $table->integer('jumlah_anggota');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};