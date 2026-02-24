<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pendaki', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel pemesanan
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->onDelete('cascade');
            // Relasi ke tabel pendaki
            $table->foreignId('pendaki_id')->constrained('pendakis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pendaki');
    }
};
