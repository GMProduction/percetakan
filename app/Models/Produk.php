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

    protected $with = 'getKategori';

    public function getKategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');
    }

    public function getHarga(){
        return $this->hasMany(Harga::class, 'id_produk');
    }

    public function scopeFilter($query, $filter){
        $query->when($filter ?? false, function ($query, $kategori) {
           return $query->whereHas('getKategori', function ($query) use ($kategori){
              $query->where('nama_kategori','=',$kategori);
           });
        });
    }
}
