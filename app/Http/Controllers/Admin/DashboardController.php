<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKertas;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DashboardController extends Controller
{
    //
    public function index(){
        $pesanan     = Pesanan::latest('updated_at')->paginate(10);
        $dataPesanan = [];
        foreach ($pesanan as $key => $p) {
            if ($p->custom) {
                $dataPesanan[$key] = $p;
                $custom            = json_decode($p->custom);
                $dataCustom        = [
                    'jenis'    => $custom->jenis,
                    'kategori' => $custom->kategori,
                    'satuan'   => $custom->satuan ?? null,
                    'laminasi' => $custom->satuan ?? null,
                ];
                $jenis             = JenisKertas::find($custom->jenis);
                $kategori          = Kategori::find($custom->kategori);
                $dataPesanan[$key] = Arr::add($dataPesanan[$key], 'jenis', $jenis);
                $dataPesanan[$key] = Arr::add($dataPesanan[$key], 'kategori', $kategori);
                $dataPesanan[$key] = Arr::set($dataPesanan[$key], 'custom', $dataCustom);

            }
        }

        return view('admin.dashboard')->with(['data' => $pesanan]);
    }
}
