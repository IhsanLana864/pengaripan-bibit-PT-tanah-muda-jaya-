<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk_bibit', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('Nama_Bibit');
            $table->string('Jenis');
            $table->integer('Umur');
            $table->string('Pupuk');
            $table->string('Nama_Benih');
            $table->decimal('Harga_Beli', 10, 2);
            $table->decimal('Harga_Jual', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk_bibit'); // Changed from 'bibit' to 'produk_bibit'
    }
};
