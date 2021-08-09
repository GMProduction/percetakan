<?php

use App\Http\Controllers\Admin\HargaController;
use App\Http\Controllers\Admin\JenisKertasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomDesainController;
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

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/user', function () {
    return view('user.dashboard');
});



Route::get('/user/keranjang', function () {
    return view('user/keranjang');
});

Route::get('/user/menunggu', function () {
    return view('user/menunggu');
});

Route::get('/user/proses', function () {
    return view('user/proses-desain');
});

Route::get('/user/pengiriman', function () {
    return view('user/pengiriman');
});

Route::get('/user/selesai', function () {
    return view('user/selesai');
});

Route::get('/user/profil', function () {
    return view('user/profil');
});


Route::prefix('/admin')->group(function (){
    Route::get('/', function (){
        return view('admin.dashboard');
    });
    Route::match(['post','get'],'/produk', [ProductController::class,'index']);
    Route::get('/produk/kategori', [KategoriController::class,'dataKategori'])->name('produk_kategori');
    Route::post('/produk/kategori', [KategoriController::class,'addKategori'])->name('add_kategori');
    Route::get('/produk/{id}', [HargaController::class,'getProdukHarga'])->name('detail_produk');
    Route::post('/produk/{id}', [HargaController::class,'addJenisHarga'])->name('detail_produk_add');
    Route::get('/produk/delete/{id}', [HargaController::class,'deleteJenisHarga'])->name('detail_produk_delete');

    Route::get('/pelanggan',[PelangganController::class,'index']);

    Route::get('/pesanan', [PesananController::class,'index']);
    Route::get('/pesanan/{id}', [PesananController::class,'detail']);
});









Route::post('/register',[AuthController::class,'register']);

Route::get('/barang', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'createProduct']);
