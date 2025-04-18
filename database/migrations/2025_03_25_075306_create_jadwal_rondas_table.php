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
        Schema::create('jadwal_rondas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->date('tanggal');
            $table->string('shift'); // Misalnya: Malam, Subuh, dll.
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_rondas');
    }
};