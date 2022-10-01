<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id'); // foreign key tabel kategory
            $table->foreignId('user_id'); // foreign key tabel user
            $table->string('title'); // judul postingan
            $table->string('slug')->unique();
            $table->text('excerpt'); // menampilkan sebagian isi postingan
            $table->text('body'); // isi postingan
            $table->timestamp('published_at')->nullable(); // tipe data untuk menyimpan tanggal perubahan apps
            $table->timestamps(); // berbeda dengan timestamp tanpa s, ini digunakan untuk created apps nya kapan, bukan tipe data
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
