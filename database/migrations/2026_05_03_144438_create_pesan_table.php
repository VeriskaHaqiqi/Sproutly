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
        Schema::create('pesan', function (Blueprint $table) {
            $table->id('id_pesan');

        // relasi ke konsultasi (chat per sesi)
            $table->foreignId('id_konsultasi')
                ->constrained('konsultasi', 'id_konsultasi')
                ->cascadeOnDelete();

            $table->enum('pengirim', ['user', 'expert']);
            $table->longText('isi_pesan')->nullable();
            $table->string('gambar')->nullable(); // simpan path gambar
            $table->timestamp('waktu_kirim')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan');
    }
};
