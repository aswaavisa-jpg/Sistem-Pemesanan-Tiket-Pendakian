<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detailpendakis', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('pemesanan_id')->constrained(); // Foreign Key
            $table->foreignId('pendaki_id')->constrained(); // Foreign Key (Anggota Tim)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpendakis');
    }
};