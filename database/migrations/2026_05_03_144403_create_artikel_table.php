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
            $table->id('id_artikel');

        // relasi ke ahli_botani
            $table->foreignId('id_ahli')
              ->constrained('ahli_botani', 'id_ahli')
              ->cascadeOnDelete();

            $table->string('judul', 50);
            $table->longText('konten');
            $table->timestamp('tanggal_unggah')->useCurrent();

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
