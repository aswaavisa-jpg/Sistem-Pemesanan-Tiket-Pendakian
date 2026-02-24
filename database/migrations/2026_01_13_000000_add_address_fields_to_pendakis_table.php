<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendakis', function (Blueprint $table) {
            $table->string('dusun')->nullable()->after('no_hp');
            $table->string('desa')->nullable()->after('dusun');
            $table->string('rt_rw')->nullable()->after('desa');
            $table->string('kecamatan')->nullable()->after('rt_rw');
            $table->string('kabupaten')->nullable()->after('kecamatan');
            $table->string('provinsi')->nullable()->after('kabupaten');
        });
    }

    public function down(): void
    {
        Schema::table('pendakis', function (Blueprint $table) {
            $table->dropColumn(['dusun', 'desa', 'rt_rw', 'kecamatan', 'kabupaten', 'provinsi']);
        });
    }
};
