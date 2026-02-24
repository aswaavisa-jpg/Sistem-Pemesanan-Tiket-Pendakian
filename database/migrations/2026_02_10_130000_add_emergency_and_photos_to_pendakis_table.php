<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pendakis', function (Blueprint $table) {
            $table->string('no_hp_darurat', 15)->nullable()->after('no_hp');
            $table->string('foto_ktp')->nullable()->after('foto');
            $table->string('foto_selfie')->nullable()->after('foto_ktp');
        });
    }

    public function down(): void
    {
        Schema::table('pendakis', function (Blueprint $table) {
            $table->dropColumn(['no_hp_darurat', 'foto_ktp', 'foto_selfie']);
        });
    }
};
