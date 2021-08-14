<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HargaController;
use App\Http\Controllers\Admin\JenisKertasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomDesainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\PelangganMiddleware;
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

Route::get('/', [HomeController::class,'index']);
Route::get('/produk', [HomeController::class,'produk']);
Route::get('/produk/detail/{id}', [HomeController::class,'detail']);
Route::post('/produk/detail/{id}', [HomeController::class,'pesanan']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class,'login']);
Route::get('/logout', [AuthController::class,'logout']);

Route::get('/register-page', function () {
    return view('registerPage');
});
Route::post('/register-page', [AuthController::class, 'registerMember']);


Route::prefix('/user')->middleware(PelangganMiddleware::class)->group(function (){
    Route::get('/', function () {
        return view('user.dashboard');
    });
    Route::get('/get-bank',[UserController::class,'getBank']);

    Route::prefix('/keranjang')->group(function (){
        Route::get('/', function () {
            return view('user.keranjang');
        });
        Route::get('/get',[UserController::class,'keranjang']);
        Route::post('/upload-image',[UserController::class,'uploadPayment']);
    });

    Route::prefix('/menunggu')->group(function (){
        Route::get('/', function () {
            return view('user.menunggu');
        });
        Route::get('/get', [UserController::class,'menunggu']);
    });

    Route::prefix('/proses')->group(function (){
        Route::get('/', function () {
            return view('user.proses-desain');
        });
        Route::get('/get', [UserController::class,'desain']);
        Route::post('/{id}/konfirmasi', [UserController::class,'konfirmasiDesain']);
    });

    Route::prefix('/pengerjaan')->group(function (){
        Route::get('/', function () {
            return view('user.pengerjaan');
        });
        Route::get('/get', [UserController::class,'pengerjaan']);
    });

    Route::prefix('/pengiriman')->group(function (){
        Route::get('/', function () {
            return view('user/pengiriman');
        });
        Route::get('/get', [UserController::class,'pengiriman']);
        Route::post('/{id}/konfirmasi', [UserController::class,'konfirmasi']);
    });

    Route::prefix('/selesai')->group(function (){
        Route::get('/', function () {
            return view('user.selesai');
        });
        Route::get('/get', [UserController::class,'selesai']);

    });

    Route::prefix('/profile')->group(function (){
        Route::get('/', function () {
            return view('user.profil');
        });
        Route::get('/get', [ProfileController::class,'getUser']);
        Route::post('/update-profile', [ProfileController::class,'updateProfile']);
        Route::post('/update-image', [ProfileController::class,'updateImage']);

    });

});



Route::prefix('/admin')->middleware(AdminMiddleware::class)->group(function (){
    Route::get('/', [DashboardController::class,'index']);
    Route::get('/kategori', [KategoriController::class,'index']);
    Route::match(['post','get'],'/bank', [BankController::class,'index']);
    Route::prefix('/produk')->group(function (){
        Route::match(['post','get'],'/', [ProductController::class,'index']);
        Route::get('/kategori', [KategoriController::class,'dataKategori'])->name('produk_kategori');
        Route::post('/kategori', [KategoriController::class,'addKategori'])->name('add_kategori');
        Route::get('/{id}', [HargaController::class,'getProdukHarga'])->name('detail_produk');
        Route::post('/{id}', [HargaController::class,'addJenisHarga'])->name('detail_produk_add');
        Route::get('/delete/{id}', [HargaController::class,'deleteJenisHarga'])->name('detail_produk_delete');
    });


    Route::get('/pelanggan',[PelangganController::class,'index']);

    Route::prefix('/pesanan')->group(function (){
        Route::get('/', [PesananController::class,'index']);
        Route::get('/{id}', [PesananController::class,'detail']);
        Route::post('/{id}/konfirmasi-pembayaran', [PesananController::class,'konfirmasiPembayaran']);
        Route::post('/{id}/proses', [PesananController::class,'proses']);
        Route::post('/{id}/desain', [PesananController::class,'addDesain']);
        Route::post('/{id}/add-harga', [PesananController::class,'addHarga']);
        Route::get('/{id}/expedisi', [PesananController::class,'getExpedisi']);
    });

});

Route::get('/kategori', [KategoriController::class,'dataKategori'])->name('produk_kategori');
Route::get('/jenis-kertas', [JenisKertasController::class,'getJenisKertas'])->name('jenis_kertas');

Route::match(['post','get'], '/custom',[CustomDesainController::class, 'index']);

Route::get('/get-city',[RajaOngkirController::class,'getCity']);
Route::get('/get-cost',[RajaOngkirController::class,'cost']);




Route::post('/register',[AuthController::class,'register']);

