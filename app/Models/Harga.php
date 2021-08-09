<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_jenis',
        'harga',
        'id_produk'
    ];
    protected $with = ['getProduk','getJenis'];

    public function getProduk(){
        return $this->belongsTo(Produk::class,'id_produk');
    }

    public function getJenis(){
        return $this->belongsTo(JenisKertas::class,'id_jenis');
    }
}
