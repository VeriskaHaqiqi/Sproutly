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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telp_user', 16)->nullable();
            $table->string('tempat_lahir_user', 30)->nullable();
            $table->date('tanggal_lahir_user')->nullable();
            $table->enum('jenis_kelamin_user', ['L', 'P'])->nullable();
            $table->string('role')->default('user');
            $table->rememberToken();
            $table->timestamps();

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }

};
