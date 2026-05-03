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
                $table->id('id_ahli');

                // relasi ke users (biar nyambung login nanti)
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

                $table->string('nama_ahli', 50);
                $table->string('no_telp_ahli', 16)->nullable();
                $table->string('tempat_lahir_ahli', 30)->nullable();
                $table->date('tanggal_lahir_ahli')->nullable();
                $table->string('email_ahli', 50)->unique();
                $table->string('password_ahli');

                $table->smallInteger('jenis_kelamin_ahli')->nullable();
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
