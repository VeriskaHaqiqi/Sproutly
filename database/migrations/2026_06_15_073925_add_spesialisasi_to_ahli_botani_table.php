<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ahli_botani', function (Blueprint $table) {
            $table->string('spesialisasi', 50)->nullable()->after('jenis_kelamin_ahli');
        });
    }

    public function down(): void
    {
        Schema::table('ahli_botani', function (Blueprint $table) {
            $table->dropColumn('spesialisasi');
        });
    }
}; 