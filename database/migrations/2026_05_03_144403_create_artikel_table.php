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
        Schema::create('artikel', function (Blueprint $table) {

            $table->id();

            // relasi ke ahli botani
            $table->foreignId('ahli_botani_id')
                ->constrained('ahli_botani')
                ->cascadeOnDelete();

            // judul artikel
            $table->string('judul', 100);

            // isi artikel
            $table->longText('konten');

            // thumbnail artikel
            $table->string('thumbnail')->nullable();

            // kategori artikel
            $table->string('kategori', 50)->nullable();

            // tanggal upload
            $table->timestamp('tanggal_unggah')
                ->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};