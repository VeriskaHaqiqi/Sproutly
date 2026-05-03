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
        Schema::create('jadwal_ahli', function (Blueprint $table) {
            $table->id('id_jadwal');

        // relasi ke ahli
            $table->foreignId('id_ahli')
              ->constrained('ahli_botani', 'id_ahli')
              ->cascadeOnDelete();

            $table->string('hari', 10);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('status_ketersediaan', 15)->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ahli');
    }
};
