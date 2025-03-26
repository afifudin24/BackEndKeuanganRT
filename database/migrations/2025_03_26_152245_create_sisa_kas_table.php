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
        Schema::create('sisa_kas', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_kas', 15, 2)->default(0);
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('sisa_kas')->insert([
            'total_kas' => 0, // Awal saldo 0
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sisa_kas');
    }
};