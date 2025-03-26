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
        Schema::create('iuran_wargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('warga_id');
            $table->decimal('jumlah', 15, 2);
            $table->string('bulan');
            $table->year('tahun');
            $table->enum('status', ['Belum Bayar', 'Sudah Bayar'])->default('Belum Bayar');
            $table->timestamps();

            $table->foreign('warga_id')->references('id')->on('wargas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuran_wargas');
    }
};