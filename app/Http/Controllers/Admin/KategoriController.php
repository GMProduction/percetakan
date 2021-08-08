<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function dataKategori(){
        $kategori = Kategori::all();
        return $kategori;
    }
}
