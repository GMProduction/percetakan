<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Baner;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HomeController extends CustomController
{
    //
    public function index()
    {
        $kategori = Kategori::all();
        $produk   = Produk::limit(4)->get();
        $data     = [
            'kategori' => $kategori,
            'produk'   => $produk,
        ];

        return view('home')->with($data);
    }

    public function produk()
    {
        $produk = Produk::filter(\request('kategori'))->paginate(8)->withQueryString();
        $kategori = Kategori::where('nama_kategori', '=', \request('kategori'))->first();
        $data     = [
            'data'     => $produk,
            'kategori' => $kategori,
        ];


        return view('produk')->with($data);
    }

    public function detail($id)
    {
        $produk = Produk::with('getHarga')->find($id);

        return view('detail')->with(['data' => $produk]);
    }

    public function pesanan($id)
    {
        $produk      = Produk::find($id);
        $dataPesanan = [
            'laminasi'      => $this->request->get('laminasi'),
            'tanggal_pesan' => $this->now->format('Y-m-d H-i-s'),
            'qty'           => $this->request->get('qty'),
            'biaya_ongkir'  => $this->request->get('ongkir'),
            'keterangan'    => $this->request->get('keterangan'),
            'alamat'        => $this->request->get('alamat'),
            'id_pelanggan'  => Auth::id(),
            'id_harga'      => $this->request->get('jenisKertas'),
            'total_harga'   => $this->request->get('totalHarga'),
            'url_gambar'    => $produk->url_gambar,
            'status_pengerjaan' => 0,
            'status_desain' => null,
            'status_bayar' => 0,

        ];

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
        $file         = $this->request->files->get('url_file');
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

    public function baner(){
        $baner = Baner::all();
        return $baner;
    }
}
