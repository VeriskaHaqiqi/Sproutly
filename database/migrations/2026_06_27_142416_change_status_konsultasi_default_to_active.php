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
        Schema::table('konsultasi', function (Blueprint $table) {
            // Ubah default status dari 'pending' menjadi 'active'
            $table->string('status_konsultasi', 20)->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            // Kembalikan ke default 'pending'
            $table->string('status_konsultasi', 20)->default('pending')->change();
        });
    }
};