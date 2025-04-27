<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stok_bibit', function (Blueprint $table) {
            $table->id(); // Primary key auto increment

            // Foreign key yang benar merujuk ke ID_Bibit di tabel bibit
            $table->unsignedBigInteger('ID_Bibit');
            $table->foreign('ID_Bibit')
                ->references('id')  // Ganti ke 'id'
                ->on('bibit')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            // Kolom stok dengan constraint unsigned (tidak boleh negatif)
            $table->unsignedInteger('Stok_Awal')->default(0);
            $table->unsignedInteger('Masuk')->default(0);
            $table->unsignedInteger('Keluar')->default(0);
            $table->unsignedInteger('Stok_Akhir')->default(0);

            $table->timestamps();

            // Tambahkan index untuk performa query
            $table->index('ID_Bibit');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stok_bibit');
    }
};
