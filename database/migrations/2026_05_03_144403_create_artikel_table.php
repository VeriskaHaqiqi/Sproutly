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

         $table->foreignId('ahli_botani_id')
            ->constrained('ahli_botani')
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
