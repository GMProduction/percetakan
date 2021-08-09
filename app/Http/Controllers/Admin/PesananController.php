<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends CustomController
{
    //
    public function index(){
        $pesanan = Pesanan::paginate(10);
        return view('admin.pesanan.pesanan')->with(['data' => $pesanan]);
    }

    public function detail($id){
        $pesanan = Pesanan::find($id);
        return $pesanan;
    }
}
