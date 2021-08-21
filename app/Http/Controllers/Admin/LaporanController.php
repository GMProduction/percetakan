<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKertas;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LaporanController extends Controller
{
    //
    public function index(){
        $total = Pesanan::where('status_pengerjaan','=',4)->sum('total_harga');
        $pesanan     = Pesanan::where('status_pengerjaan','=',4)->latest('updated_at')->paginate(10);

        $dataPesanan = [];
        foreach ($pesanan as $key => $p) {
            if ($p->getHarga){
                Arr::add($p, 'harga_satuan', $p->getHarga->harga);
            }
            if ($p->custom) {
                $custom            = json_decode($p->custom);
                $dataCustom        = [
                    'jenis'    => $custom->jenis,
                    'kategori' => $custom->kategori,
                    'satuan'   => $custom->satuan ?? null,
                    'laminasi' => $custom->satuan ?? null,
                ];
                $jenis             = JenisKertas::find($custom->jenis);
                $kategori          = Kategori::find($custom->kategori);
                Arr::add($p, 'jenis', $jenis);
                Arr::add($p, 'kategori', $kategori);
                Arr::set($p, 'custom', $dataCustom);
                Arr::add($p, 'harga_satuan', $custom->satuan);
            }
        }

        $data = [
            'data' => $pesanan,
            'total' => $total
        ];
        return view('admin.laporan')->with($data);
    }
}
