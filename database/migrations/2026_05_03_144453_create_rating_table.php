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
            $table->id();

            // user
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // ahli botani
            $table->foreignId('ahli_botani_id')
                ->constrained('ahli_botani')
                ->cascadeOnDelete();

            // konsultasi
            $table->foreignId('konsultasi_id')
                ->constrained('konsultasi')
                ->cascadeOnDelete();

            $table->integer('nilai');
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
