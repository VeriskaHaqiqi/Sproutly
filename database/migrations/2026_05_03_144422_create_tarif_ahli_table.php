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
        Schema::create('tarif_ahli', function (Blueprint $table) {
            $table->id();

            // relasi ke ahli
            $table->foreignId('ahli_botani_id')
                ->constrained('ahli_botani')
                ->cascadeOnDelete();

            $table->decimal('tarif', 12, 2); // harga
            $table->date('tgl_mulai_berlaku');
            $table->date('tgl_akhir_berlaku')->nullable();
            $table->string('status_aktif', 10)->default('aktif');

            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_ahli');
    }
};
