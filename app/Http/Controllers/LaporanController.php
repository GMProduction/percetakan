<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function cetakLaporan(Request $request)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataLaporan($request))->setPaper('A4', 'potrait');
        return $pdf->stream();
    }

    public function dataLaporan($date)
    {
     
        return view('admin/cetaklaporan');
    }
}
