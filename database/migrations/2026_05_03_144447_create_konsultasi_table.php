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
            $table->id('id_konsultasi');

            // relasi ke user
            $table->foreignId('id_user')
                ->constrained('users')
                ->cascadeOnDelete();

            // relasi ke ahli
            $table->foreignId('id_ahli')
                ->constrained('ahli_botani', 'id_ahli')
                ->cascadeOnDelete();

            // relasi ke pembayaran
            $table->foreignId('id_pembayaran')
                ->nullable()
                ->constrained('pembayaran', 'id_pembayaran')
                ->nullOnDelete();

            // relasi ke tarif
            $table->foreignId('id_tarif')
                ->nullable()
                ->constrained('tarif_ahli', 'id_tarif')
                ->nullOnDelete();

            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->string('status_konsultasi', 20)->default('pending');
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
