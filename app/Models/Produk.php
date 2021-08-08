<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'url_gambar',
        'deskripsi',
        'biaya_laminasi',
    ];

    protected $with = ['getKategori','getHarga'];

    public function getkategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');
    }

    public function getHarga(){
        return $this->hasMany(Harga::class, 'id_produk');
    }
}
