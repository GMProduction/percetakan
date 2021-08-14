<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class KategoriController extends CustomController
{
    //

    public function index(){
        $kategori = Kategori::paginate(10);
        return view('admin.kategori.kategori')->with(['data' => $kategori]);
    }

    public function dataKategori()
    {
        $kategori = Kategori::all();

        return $kategori;
    }

    public function addKategori()
    {
        $field = \request()->validate(
            [
                'nama_kategori' => 'required',
            ]
        );

        $img = $this->request->files->get('url_gambar');
        if ($img || $img != '') {
            $image     = $this->generateImageName('url_gambar');
            $stringImg = '/images/kategori/'.$image;
            $this->uploadImage('url_gambar', $image, 'imageKategori');
            $field = Arr::add($field, 'url_gambar', $stringImg);
        }
        if ($this->request->get('id')) {
            $kategori = Kategori::find($this->request->get('id'));
            if ($img && $kategori->url_gambar){
                if (file_exists('../public'.$kategori->url_gambar)) {
                    unlink('../public'.$kategori->url_gambar);
                }
            }
            $kategori->update($field);
        } else {
            Kategori::create($field);

        }
        return response()->json([
            'msg' => 'berhasil'
        ],200);
    }
}
