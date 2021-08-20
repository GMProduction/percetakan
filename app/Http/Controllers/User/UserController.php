<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\JenisKertas;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends CustomController
{
    //

    public function keranjang()
    {
        $pesanan = Pesanan::where([['status_bayar', '=', 0], ['id_pelanggan', '=', Auth::id()]])->get();
        $data    = [];
        foreach ($pesanan as $key => $p) {
            if ($p->getPembayaran == null) {
                $data[$key] = $p;
                $custom     = json_decode($p->custom);
                $data[$key] = Arr::set($data[$key], 'custom', $custom);
            }
        }

        return $data;
    }

    public function menunggu()
    {
        $pesanan = Pesanan::where([['status_bayar', '<=', 1], ['status_pengerjaan', '=', 0], ['id_pelanggan', '=', Auth::id()]])->get();
        $data    = [];
        foreach ($pesanan as $key => $p) {
            if ($p->getPembayaran != null) {
                $data[$key] = $p;
                $custom     = json_decode($p->custom);
                $data[$key] = Arr::set($data[$key], 'custom', $custom);
            }
        }

        return $data;
    }

    public function desain()
    {
        $pesanan = Pesanan::with('getDesain')->where([['status_pengerjaan', '=', 1], ['status_bayar', '=', 1], ['id_pelanggan', '=', Auth::id()]])->get();
        $data    = [];
        foreach ($pesanan as $key => $p) {
            $data[$key] = $p;
            $custom     = json_decode($p->custom);
            $data[$key] = Arr::set($data[$key], 'custom', $custom);
            if ($custom && $custom->kategori) {
                $kategori   = Kategori::find($custom->kategori);
                $data[$key] = Arr::set($data[$key], 'kategori', $kategori);
            }
            if ($custom && $custom->jenis) {
                $jenis      = JenisKertas::find($custom->jenis);
                $data[$key] = Arr::set($data[$key], 'jenis_kertas', $jenis);
            }
        }

        return $data;
    }

    public function pengerjaan()
    {
        $pesanan = Pesanan::with('getDesain')->where([['status_pengerjaan', '=', 2], ['status_bayar', '=', 1], ['id_pelanggan', '=', Auth::id()]])->get();
        $data    = [];
        foreach ($pesanan as $key => $p) {
            $data[$key] = $p;
            $custom     = json_decode($p->custom);
            $data[$key] = Arr::set($data[$key], 'custom', $custom);

        }

        return $data;
    }

    public function pengiriman()
    {
        $pesanan = Pesanan::with('getDesain')->where([['status_pengerjaan', '=', 3], ['status_bayar', '=', 1], ['id_pelanggan', '=', Auth::id()]])->get();
        $data    = [];
        foreach ($pesanan as $key => $p) {
            $data[$key] = $p;
            $custom     = json_decode($p->custom);
            $data[$key] = Arr::set($data[$key], 'custom', $custom);
            if ($custom && $custom->kategori) {
                $kategori   = Kategori::find($custom->kategori);
                $data[$key] = Arr::set($data[$key], 'kategori', $kategori);
            }
            if ($custom && $custom->jenis) {
                $jenis      = JenisKertas::find($custom->jenis);
                $data[$key] = Arr::set($data[$key], 'jenis_kertas', $jenis);
            }
        }

        return $data;
    }

    public function selesai()
    {
        $pesanan = Pesanan::with('getDesain')->where([['status_pengerjaan', '=', 4], ['status_bayar', '=', 1], ['id_pelanggan', '=', Auth::id()]])->get();
        $data    = [];
        foreach ($pesanan as $key => $p) {
            $data[$key] = $p;
            $custom     = json_decode($p->custom);
            $data[$key] = Arr::set($data[$key], 'custom', $custom);
            if ($custom && $custom->kategori) {
                $kategori   = Kategori::find($custom->kategori);
                $data[$key] = Arr::set($data[$key], 'kategori', $kategori);
            }

            if ($custom && $custom->jenis) {
                $jenis      = JenisKertas::find($custom->jenis);
                $data[$key] = Arr::set($data[$key], 'jenis_kertas', $jenis);
            }
        }

        return $data;
    }

    public function getProductId($id)
    {
        $pesanan    = Pesanan::find($id);
        $custom     = json_decode($pesanan->custom);
        Arr::set($pesanan, 'custom', $custom);
        if ($custom && $custom->kategori) {
            $kategori   = Kategori::find($custom->kategori);
            Arr::set($pesanan, 'kategori', $kategori);
        }
        if ($custom && $custom->jenis) {
            $jenis      = JenisKertas::find($custom->jenis);
            Arr::set($pesanan, 'jenis_kertas', $jenis);
        }

        return $pesanan;
    }

    public function uploadPayment()
    {
        $pesanan   = Pesanan::find(\request('id'));
        $data      = [
            'id_bank'    => \request('bank'),
            'id_pesanan' => \request('id'),
        ];
        $image     = $this->generateImageName('url_gambar');
        $stringImg = '/images/payment/'.$image;
        $this->uploadImage('url_gambar', $image, 'imagePayment');
        $data = Arr::add($data, 'url_gambar', $stringImg);
        if ($pesanan->getPembayaran) {
            if (file_exists('../public'.$pesanan->getPembayaran->url_gambar)) {
                unlink('../public'.$pesanan->getPembayaran->url_gambar);
            }
            $pesanan->getPembayaran()->update($data);
        } else {
            $pesanan->getPembayaran()->create($data);
        }

        return response()->json('berhasil', 200);

    }

    public function getBank()
    {
        $bank = Bank::all();

        return $bank;
    }

    public function konfirmasiDesain($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->update(['status_desain' => $this->request->get('status')]);

        return response()->json('berhasil', 200);
    }

    public function konfirmasi($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->update(['status_pengerjaan' => 4]);

        return response()->json('berhasil', 200);
    }

    public function deleteKeranjang($id){
        Pesanan::destroy($id);
        return response()->json('berhasil');
    }

}
