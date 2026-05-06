<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Fix detail_pesanans -> produks
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->dropForeign(['produk_id']);
            $table->unsignedBigInteger('produk_id')->nullable()->change();
            $table->foreign('produk_id')
                  ->references('id')->on('produks')
                  ->onDelete('set null');
        });

        // Fix produks -> kategoris
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->unsignedBigInteger('kategori_id')->nullable()->change();
            $table->foreign('kategori_id')
                  ->references('id')->on('kategoris')
                  ->onDelete('set null');
        });

        // Fix pesanans -> users
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });

        // Fix detail_pesanans -> pesanans
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->foreign('pesanan_id')
                  ->references('id')->on('pesanans')
                  ->onDelete('cascade');
        });

        // Fix pembayarans -> pesanans
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropForeign(['pesanan_id']);
            $table->foreign('pesanan_id')
                  ->references('id')->on('pesanans')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        // Tidak perlu rollback
    }
};