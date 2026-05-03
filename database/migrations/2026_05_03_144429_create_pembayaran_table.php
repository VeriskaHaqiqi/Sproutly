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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');

            $table->decimal('jumlah', 12, 2);
            $table->string('metode', 20);
            $table->string('bukti_transfer')->nullable(); // simpan path file
            $table->timestamp('tgl_pembayaran')->nullable();
            $table->string('status_pembayaran', 15)->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
