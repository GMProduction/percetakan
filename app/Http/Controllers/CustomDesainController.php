<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\JenisKertas;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CustomDesainController extends CustomController
{
    //

    public function index()
    {

        if (\request()->isMethod('POST')) {
            $dataPesanan = [
                'laminasi'          => $this->request->get('laminasi'),
                'tanggal_pesan'     => $this->now->format('Y-m-d H-i-s'),
                'qty'               => $this->request->get('qty'),
                'biaya_ongkir'      => $this->request->get('ongkir'),
                'keterangan'        => $this->request->get('keterangan'),
                'alamat'            => $this->request->get('alamat'),
                'id_pelanggan'      => Auth::id(),
                'status_pengerjaan' => 0,
                'status_desain' => 0,
                'status_bayar' => 0

            ];
            $dataCustom  = [
                'jenis'    => $this->request->get('jenisKertas'),
                'kategori' => $this->request->get('kategori'),
                'satuan'   => null,
                'laminasi' => null,
            ];

            $dataPesanan  = Arr::add($dataPesanan, 'custom', json_encode($dataCustom));
            $dataExpedisi = [
                'nama'          => $this->request->get('kurir'),
                'service'       => $this->request->get('service'),
                'estimasi'      => $this->request->get('estimasi'),
                'id_kota'       => $this->request->get('kota'),
                'nama_kota'     => $this->request->get('nama_kota'),
                'id_propinsi'   => $this->request->get('propinsiid'),
                'nama_propinsi' => $this->request->get('propinsi'),
                'biaya'         => $this->request->get('ongkir'),
            ];
            $gambar       = $this->request->files->get('url_gambar');
            $file         = $this->request->files->get('url_file');

            if ($gambar || $gambar != '') {
                $image     = $this->generateImageName('url_gambar');
                $stringImg = '/images/custom/'.$image;
                $this->uploadImage('url_gambar', $image, 'imageCustom');
                $dataPesanan = Arr::add($dataPesanan, 'url_gambar', $stringImg);
            }

            if ($file || $file != '') {
                $image     = $this->generateImageName('url_file');
                $stringImg = '/images/file/'.$image;
                $this->uploadImage('url_file', $image, 'imageFile');
                $dataPesanan = Arr::add($dataPesanan, 'url_file', $stringImg);
            }

            $pesanan = Pesanan::create($dataPesanan);
            $pesanan->getExpedisi()->create($dataExpedisi);

            return response()->json('berhasil');
        }
        $kategori = Kategori::all();
        $jenis    = JenisKertas::all();
        $data     = [
            'kategori' => $kategori,
            'jenis'    => $jenis,
        ];

        return view('detail-custom')->with($data);
    }

}
