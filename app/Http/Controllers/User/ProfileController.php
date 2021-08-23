<?php

namespace App\Http\Controllers\User;

use App\Helper\CustomController;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends CustomController
{
    //
    public function getUser()
    {
        $user = User::with('getPelanggan')->find(Auth::id());

        return $user;
    }

    public function updateProfile()
    {
        $field          = $this->request->validate(
            [
                'username' => 'required|string',
                'password' => 'required|string|confirmed',

            ]
        );
        $fieldPelanggan = $this->request->validate(
            [
                'nama'   => 'required|string',
                'alamat' => 'required',
                'no_hp'  => 'required',
            ]
        );

        $number    = strpos($fieldPelanggan['no_hp'], "0") == 0 ? preg_replace('/0/', '62', $fieldPelanggan['no_hp'], 1) : $fieldPelanggan['no_hp'];
        $fieldData =
            [
                'nama'     => $fieldPelanggan['nama'],
                'alamat'   => $fieldPelanggan['alamat'],
                'no_hp'    => $number,
            ];

        $cekUser        = User::where([['id', '!=', Auth::id()], ['username', '=', $field['username']]])->first();
        if ($cekUser) {
            return response()->json(
                [
                    "msg" => "The username has already been taken.",
                ],
                '201'
            );
        }
        $user = User::find(Auth::id());

        $user->update(
            [
                'username' => $field['username'],
            ]
        );
        if (strpos($field['password'], '*') === false) {
            $user->update(
                [
                    'password' => Hash::make($field['password']),
                ]
            );
        }

        $user->getPelanggan()->update($fieldData);

        return response()->json('berhasil', 200);
    }

    public function updateImage(){
        $pelanggan = Pelanggan::where('id_user','=',Auth::id())->first();
        $image     = $this->generateImageName('image');
        $stringImg = '/images/profile/'.$image;
        $this->uploadImage('image', $image, 'imageProfile');

        if ($pelanggan->image) {
            if (file_exists('../public'.$pelanggan->image)) {
                unlink('../public'.$pelanggan->image);
            }
        }
        $pelanggan->update(['image' => $stringImg]);
        return response()->json('berhasil', 200);
    }
}
