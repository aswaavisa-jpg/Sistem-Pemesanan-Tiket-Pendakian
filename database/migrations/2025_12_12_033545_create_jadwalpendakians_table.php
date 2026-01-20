<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_pendakians', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('gunung_id')->constrained(); // Foreign Key
            $table->date('tanggal_naik');
            $table->date('tanggal_turun');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pendakians');
    }
};