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

    public function getPesanan($start, $end)
    {

        $pesanan = Pesanan::where('status_pengerjaan', '=', 4)->latest('updated_at');
        if ($start) {
            $pesanan = $pesanan->whereBetween('tanggal_pesan', [date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end))]);
        }
        $pesanan = $pesanan->paginate(10);

        $dataPesanan = [];
        foreach ($pesanan as $key => $p) {
            if ($p->getHarga) {
                Arr::add($p, 'harga_satuan', $p->getHarga->harga);
            }
            if ($p->custom) {
                $custom     = json_decode($p->custom);
                $dataCustom = [
                    'jenis'    => $custom->jenis,
                    'kategori' => $custom->kategori,
                    'satuan'   => $custom->satuan ?? null,
                    'laminasi' => $custom->satuan ?? null,
                ];
                $jenis      = JenisKertas::find($custom->jenis);
                $kategori   = Kategori::find($custom->kategori);
                Arr::add($p, 'jenis', $jenis);
                Arr::add($p, 'kategori', $kategori);
                Arr::set($p, 'custom', $dataCustom);
                Arr::add($p, 'harga_satuan', $custom->satuan);
            }
        }

        return $pesanan;
    }

    public function index()
    {
        $start = \request('start');
        $end   = \request('end');

        $total   = Pesanan::where('status_pengerjaan', '=', 4);
        if ($start) {
            $pesanan = $total->whereBetween('tanggal_pesan', [date('Y-m-d', strtotime($start)), date('Y-m-d', strtotime($end))]);
        }
        $total = $total->sum('total_harga');
        $pesanan = $this->getPesanan($start, $end);

        $data = [
            'data'  => $pesanan,
            'total' => $total,
        ];

        return view('admin.laporan')->with($data);
    }

    public function cetakLaporan(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLaporan())->setPaper('F4', 'landscape');

        return $pdf->stream();
    }

    public function dataLaporan()
    {
        $pesanan = $this->getPesanan(\request('start'), \request('end'));
        $data = [
            'start' => \request('start'),
            'end' => \request('end'),
            'data' => $pesanan
        ];

        return view('admin/cetaklaporan')->with($data);
    }
}
