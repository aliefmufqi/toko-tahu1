<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->string('badge')->default('NEW');
            $table->string('badge_color')->default('#FF5C00');
            $table->string('emoji')->default('🧀');
            $table->integer('waktu')->default(15); // dalam menit
            $table->string('level')->default('Beginner');
            $table->integer('harga')->default(0);
            $table->text('deskripsi');
            $table->json('bahan');   // array bahan
            $table->json('langkah'); // array langkah
            $table->text('tips')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reseps');
    }
};