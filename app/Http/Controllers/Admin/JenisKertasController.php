<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKertas;
use Illuminate\Http\Request;

class JenisKertasController extends Controller
{
    //
    public function getJenisKertas(){
        $jenis = JenisKertas::all();
        return $jenis;
    }
}
