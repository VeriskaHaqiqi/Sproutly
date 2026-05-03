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
        Schema::create('rating', function (Blueprint $table) {
            $table->id('id_rating');

        // relasi ke user
            $table->foreignId('id_user')
              ->constrained('users')
              ->cascadeOnDelete();

            // relasi ke ahli
            $table->foreignId('id_ahli')
              ->constrained('ahli_botani', 'id_ahli')
              ->cascadeOnDelete();

            // relasi ke konsultasi
            $table->foreignId('id_konsultasi')
                  ->constrained('konsultasi', 'id_konsultasi')
                  ->cascadeOnDelete();

            $table->integer('nilai'); // misalnya 1–5
            $table->longText('ulasan')->nullable();
            $table->timestamp('tanggal')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
