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
        Schema::create('konsultasi', function (Blueprint $table) {

            $table->id();

            // user
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // ahli botani
            $table->foreignId('ahli_botani_id')
                ->constrained('ahli_botani')
                ->cascadeOnDelete();

            // pembayaran
            $table->foreignId('pembayaran_id')
                ->nullable()
                ->constrained('pembayaran')
                ->nullOnDelete();

            // tarif
            $table->foreignId('tarif_ahli_id')
                ->nullable()
                ->constrained('tarif_ahli')
                ->nullOnDelete();

            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();

            $table->string('status_konsultasi', 20)
                ->default('pending');

            $table->string('topik', 100)->nullable();

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
