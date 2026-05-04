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
        Schema::create('ahli_botani', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('nama_ahli', 50);
            $table->string('no_telp_ahli', 16)->nullable();
            $table->string('tempat_lahir_ahli', 30)->nullable();
            $table->date('tanggal_lahir_ahli')->nullable();

            $table->enum('jenis_kelamin_ahli', ['L', 'P'])->nullable();
            $table->string('domisili', 30)->nullable();
            $table->string('nama_almamater', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahli_botani');
    }
};
