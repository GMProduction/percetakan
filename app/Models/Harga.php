<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_kertas',
        'harga',
        'id_produk'
    ];

    public function getProduk(){
        return $this->belongsTo(Produk::class,'id_produk');
    }
}
