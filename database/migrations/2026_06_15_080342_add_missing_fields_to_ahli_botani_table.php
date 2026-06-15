<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ahli_botani', function (Blueprint $table) {

            if (!Schema::hasColumn('ahli_botani', 'bio')) {
                $table->text('bio')->nullable();
            }

            if (!Schema::hasColumn('ahli_botani', 'pengalaman_tahun')) {
                $table->integer('pengalaman_tahun')->default(0);
            }

        });
    }

    public function down(): void
    {
        Schema::table('ahli_botani', function (Blueprint $table) {

            if (Schema::hasColumn('ahli_botani', 'bio')) {
                $table->dropColumn('bio');
            }

            if (Schema::hasColumn('ahli_botani', 'pengalaman_tahun')) {
                $table->dropColumn('pengalaman_tahun');
            }

        });
    }
};