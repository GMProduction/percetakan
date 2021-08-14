<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Expedisi;
use App\Models\JenisKertas;
use App\Models\Kategori;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PesananController extends CustomController
{
    //
    public function index()
    {
        $pesanan     = Pesanan::with('getDesain')->latest('updated_at')->paginate(10);
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

    public function addHarga($id)
    {
        $pesanan    = Pesanan::find($id);
        $js         = json_decode($pesanan->custom);
        $dataCustom = [
            'jenis'    => $js->jenis,
            'kategori' => $js->kategori,
            'satuan'   => (int)\request('hargaSatuan'),
            'laminasi' => (int)\request('hargaLaminasi'),
        ];
        $harga      = $this->request->get('totalHarga');
        $harga      = str_replace(',', '', $harga);
        $data       = [
            'total_harga' => (int)$harga,
            'custom'      => json_encode($dataCustom),
        ];
        $pesanan->update($data);
        return response()->json('berhasil');
    }

    public function konfirmasiPembayaran($id){
        $pesanan = Pesanan::find($id);
        $status = $this->request->get('status');
        if ($status == '1'){
            $pesanan->update([
                'status_bayar' => $status
            ]);
        }else{
           if ($pesanan->getPembayaran){
               if (file_exists('../public'.$pesanan->getPembayaran->url_gambar)) {
                   unlink('../public'.$pesanan->getPembayaran->url_gambar);
               }
           }
           Pembayaran::destroy($pesanan->getPembayaran->id);
        }
        return response()->json('berhasil',200);
    }

    public function proses($id){
        $pesanan = Pesanan::find($id);
        $pesanan->update(['status_pengerjaan' => $this->request->get('status')]);
        if ($this->request->get('status') == '1'){
            $pesanan->update(['status_desain' => 0]);
        }
        return response()->json('berhasil',200);
    }

    public function addDesain($id){
        $pesanan = Pesanan::find($id);

        $image     = $this->generateImageName('url_desain');
        $stringImg = '/images/desain/'.$image;
        $this->uploadImage('url_desain', $image, 'imageDesain');
        $pesanan->update(['status_desain' => 1]);

        if ($pesanan->getDesain && $pesanan->getDesain->url_desain) {
            if (file_exists('../public'.$pesanan->getDesain->url_desain)) {
                unlink('../public'.$pesanan->getDesain->url_desain);
            }
            $pesanan->getDesain()->update(['url_desain' => $stringImg]);
        }else{
            $pesanan->getDesain()->create(['url_desain' => $stringImg]);
        }
        return response()->json('berhasil',200);
    }

    public function getExpedisi($id){
        $expedisi = Expedisi::where('id_pesanan','=',$id)->first();
        return $expedisi;
    }
}
