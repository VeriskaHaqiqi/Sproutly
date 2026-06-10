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
            $table->id();

            $table->foreignId('konsultasi_id')
                ->constrained('konsultasi')
                ->cascadeOnDelete();

            $table->enum('pengirim', ['user', 'ahli']);
            $table->longText('isi_pesan')->nullable();
            $table->string('gambar')->nullable();
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
