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
        Schema::create('pembayarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pesanan_id')->constrained('pesanans');
        $table->string('metode_bayar'); // transfer, cod
        $table->decimal('jumlah_bayar', 12, 2);
        $table->string('bukti_transfer')->nullable();
        $table->enum('status', ['menunggu', 'dikonfirmasi', 'ditolak'])->default('menunggu');
        $table->timestamp('tanggal_bayar')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
