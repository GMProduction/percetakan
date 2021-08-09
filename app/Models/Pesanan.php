<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_harga',
        'id_pelanggan',
        'total_harga',
        'status_bayar',
        'status_pengerjaan',
        'tanggal_pesan',
        'qty',
        'biaya_ongkir',
        'laminasi',
        'keterangan',
        'status_desain',
        'url_gambar',
    ];

    protected $with = ['getHarga.getProduk','getUser.getPelanggan'];

    public function getHarga(){
        return $this->belongsTo(Harga::class,'id_harga');
    }

    public function getUser(){
        return $this->belongsTo(User::class,'id_pelanggan');
    }
}
