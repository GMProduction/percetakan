<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends CustomController
{
    //
    public function index()
    {
        if ($this->request->isMethod('POST')){
            $field = \request()->validate(
                [
                    'id_kategori'    => 'required',
                    'nama_produk'    => 'required',
                    'deskripsi'      => 'required',
                    'biaya_laminasi' => 'required',
                ]
            );

            $img = $this->request->files->get('url_gambar');
            if ($img || $img != '') {
                $image     = $this->generateImageName('url_gambar');
                $stringImg = '/images/produk/'.$image;
                $this->uploadImage('url_gambar', $image, 'imageProduk');
                $field = Arr::add($field, 'url_gambar', $stringImg);
            }
            if (\request('id')) {
                $produk = Produk::find(\request('id'));
                if ($img && $produk->url_gambar) {
                    if (file_exists('../public'.$produk->url_gambar)) {
                        unlink('../public'.$produk->url_gambar);
                    }
                }
                $produk->update($field);
            } else {
                Produk::create($field);
            }
            return response()->json([
                'msg' => 'berhasil'
            ],200);
        }
        $produk = Produk::with(['getHarga.getJenis'])->paginate(10);

        return view('admin.produk.produk')->with(['data' => $produk]);
    }



}
