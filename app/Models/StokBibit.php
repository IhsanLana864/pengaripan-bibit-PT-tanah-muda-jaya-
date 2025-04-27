<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBibit extends Model
{
    use HasFactory;

    protected $table = 'stok_bibit';

    protected $fillable = [
        'ID_Bibit',
        'Stok_Awal',
        'Masuk',
        'Keluar',
        'Stok_Akhir',
    ];

    public function produkBibit()
    {
        return $this->belongsTo(ProdukBibit::class, 'ID_Bibit');
    }

    public function bibit()
    {
        return $this->belongsTo(ProdukBibit::class, 'ID_Bibit', 'id');
    }

    // Menghitung stok akhir sebelum menyimpan
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($stokBibit) {
            $stokBibit->Stok_Akhir = $stokBibit->Stok_Awal + $stokBibit->Masuk - $stokBibit->Keluar;
        });
    }

}
