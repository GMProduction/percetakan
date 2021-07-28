<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register-page', function () {
    return view('registerPage');
});

Route::get('/user', function () {
    return view('user/dashboard');
});

Route::get('/admin', function () {
    return view('admin/dashboard');
});

Route::get('/admin/barang', function () {
    return view('admin/barang/barang');
});

Route::get('/admin/guru', function () {
    return view('admin/guru/guru');
});

Route::get('/admin/siswa', function () {
    return view('admin/siswa/siswa');
});

Route::get('/admin/mapel', function () {
    return view('admin/mapel/mapel');
});

Route::get('/admin/laporanpinjaman', function () {
    return view('admin/laporan/pinjamalat');
});


Route::post('/register',[AuthController::class,'register']);

Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'createProduct']);
