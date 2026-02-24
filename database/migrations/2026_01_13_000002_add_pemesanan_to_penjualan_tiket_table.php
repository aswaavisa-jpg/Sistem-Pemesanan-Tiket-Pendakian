<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan_tiket', function (Blueprint $table) {
            $table->foreignId('pemesanan_id')->nullable()->constrained('pemesanans')->onDelete('cascade');
            $table->decimal('harga_per_orang', 10, 0)->default(20000);
        });
    }

    public function down(): void
    {
        Schema::table('penjualan_tiket', function (Blueprint $table) {
            $table->dropForeign(['pemesanan_id']);
            $table->dropColumn(['pemesanan_id', 'harga_per_orang']);
        });
    }
};
