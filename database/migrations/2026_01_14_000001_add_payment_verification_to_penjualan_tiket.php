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
        Schema::table('penjualan_tiket', function (Blueprint $table) {
            // Status pembayaran: pending, verified, rejected
            $table->enum('status_pembayaran', ['pending', 'verified', 'rejected'])->default('pending')->after('total_harga');
            
            // Metode pembayaran: transfer, cash, etc
            $table->string('metode_pembayaran')->nullable()->after('status_pembayaran');
            
            // Bukti pembayaran (path ke file)
            $table->string('bukti_pembayaran')->nullable()->after('metode_pembayaran');
            
            // Admin yang memverifikasi
            $table->unsignedBigInteger('verified_by')->nullable()->after('bukti_pembayaran');
            
            // Waktu verifikasi
            $table->timestamp('verified_at')->nullable()->after('verified_by');
            
            // Catatan verifikasi dari admin
            $table->text('catatan_verifikasi')->nullable()->after('verified_at');
            
            // Foreign key ke users table
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan_tiket', function (Blueprint $table) {
            $table->dropForeign(['verified_by']);
            $table->dropColumn([
                'status_pembayaran',
                'metode_pembayaran',
                'bukti_pembayaran',
                'verified_by',
                'verified_at',
                'catatan_verifikasi'
            ]);
        });
    }
};
