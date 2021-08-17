<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKertas;
use Illuminate\Http\Request;

class JenisKertasController extends Controller
{
    //
    public function index(){
        if (\request()->isMethod('POST')){
            if (\request('id')){
                $jenis = JenisKertas::find(\request('id'));
                $jenis->update(\request()->all());
            }else{
                JenisKertas::create(\request()->all());
            }
            return response()->json('berhasil');
        }
        $jenis = JenisKertas::paginate(10);
        return view('admin.jenis.jenis')->with(['data' => $jenis]);
    }


    public function getJenisKertas(){
        $jenis = JenisKertas::all();
        return $jenis;
    }

}
