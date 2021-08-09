<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends CustomController
{
    //
    public function index(){
        $user = User::with('getPelanggan')->paginate(10);
        return view('admin.pelanggan.pelanggan')->with(['data' => $user]);
    }
}
