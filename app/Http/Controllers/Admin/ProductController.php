<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Harga;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $produk = Produk::all();

        return view('admin.produk.produk')->with(['data' => $produk]);
    }


}
