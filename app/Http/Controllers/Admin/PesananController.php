<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\JenisKertas;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PesananController extends CustomController
{
    //
    public function index()
    {
        $pesanan     = Pesanan::paginate(10);
        $dataPesanan = [];
        foreach ($pesanan as $key => $p) {
            if ($p->custom) {
                $dataPesanan[$key] = $p;
                $custom            = json_decode($p->custom);
                $dataCustom = [
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

        return view('admin.pesanan.pesanan')->with(['data' => $pesanan]);
    }

    public function detail($id)
    {
        $pesanan = Pesanan::find($id);
        if ($pesanan->custom) {
            $custom     = json_decode($pesanan->custom);
            $dataCustom = [
                'jenis'    => $custom->jenis,
                'kategori' => $custom->kategori,
                'satuan'   => $custom->satuan ?? null,
                'laminasi' => $custom->satuan ?? null,
            ];
            $jenis      = JenisKertas::find($custom->jenis);
            $kategori   = Kategori::find($custom->kategori);
            $pesanan    = Arr::add($pesanan, 'jenis', $jenis);
            $pesanan    = Arr::add($pesanan, 'kategori', $kategori);
            $pesanan    = Arr::set($pesanan, 'custom', $custom);
        }

        return $pesanan;
    }

    public function addHarga(){
        $data = [
            'total_harga' => $this->request->get('totalHarga'),
            'custom' => ''
        ];
    }
}
