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
        Schema::create('profile_rs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rs', 50);
            $table->string('no_hp', 20);
            $table->text('alamat');
            $table->string('email', 20);
            $table->text('logo_app');
            $table->text('informasi_rs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_rs');
    }
};
