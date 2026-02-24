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
        Schema::table('detail_pendaki', function (Blueprint $table) {
            $table->string('status_pendakian')->default('aktif')->after('pendaki_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_pendaki', function (Blueprint $table) {
            $table->dropColumn('status_pendakian');
        });
    }
};
