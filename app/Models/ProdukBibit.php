<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukBibit extends Model
{
    use HasFactory;

    protected $table = 'produk_bibit';

    protected $fillable = [
        'Nama_Bibit',
        'Jenis',
        'Umur',
        'Pupuk',
        'Nama_Benih',
        'Harga_Beli',
        'Harga_Jual'
    ];

    public function stokBibit()
    {
        return $this->hasMany(StokBibit::class, 'ID_Bibit');
    }
}
