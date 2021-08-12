<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends CustomController
{
    //

    public function keranjang()
    {
        $pesanan = Pesanan::where([['status_bayar', '=', 0], ['id_pelanggan', '=', Auth::id()]])->get();

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
    }

    public function getBank()
    {
        $bank = Bank::all();

        return $bank;
    }
}
