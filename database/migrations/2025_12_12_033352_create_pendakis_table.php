<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendakis', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('jenis_kelamin');
            $table->string('no_hp');
            $table->text('alamat');
            $table->timestamps();
        });
    }
    // ... down method
};