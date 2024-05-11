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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_pasien', 50);
            $table->string('no_hp', 20);
            $table->integer('bb');
            $table->integer('tb');
            $table->string('jk', 20);
            $table->integer('usia');
            $table->string('tempat_lahir', 20);
            $table->date('tgl_lahir');
            $table->string('relasi', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
