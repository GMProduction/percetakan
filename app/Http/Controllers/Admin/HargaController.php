<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Produk;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    //
    public function getProdukHarga($id)
    {
        $produk = Produk::find($id);

        return $produk;
    }

    public function addJenisHarga($id)
    {
        $field = \request()->validate(
            [
                'jenis_kertas' => 'required',
                'harga'        => 'required',
            ]
        );

        if (\request('id')) {
            $harga = Harga::find(\request('id'));
            $harga->update([
                'jenis_kertas' => $field['jenis_kertas'],
                'harga' => $field['harga'],
            ]);
        } else {
            Harga::create(\request()->all());
        }
        return response()->json([
            'msg' => 'berhasil'
        ],200);
    }

    public function deleteJenisHarga($id){
        Harga::destroy($id);
        return response()->json([
            'msg' => 'deleted'
        ],200);
    }
}
