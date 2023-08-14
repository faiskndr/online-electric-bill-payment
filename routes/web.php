<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\Pelanggan\BerandaController;
use App\Http\Controllers\Pelanggan\TagihanPelangganController;
use App\Http\Controllers\Pelanggan\PembayaranController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\KonfirmasiPembayaranController;
use App\Http\Controllers\LaporanController;


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

Route::middleware(['auth:admin'])->group(function(){
    
    Route::resource('/pelanggan',PelangganController::class);
    Route::get('/verifikasi', [PelangganController::class,'konfirmasi'])->name('verify');
    Route::get('/',[DashboardController::class,'index'])->name('dashboard')->middleware('isadmin');
    
    Route::resource('/bank',BankController::class)->middleware('isadmin');
    

    Route::resource('/tarif',TarifController::class);
    // Route::get('/penggunaan/{id}/create', [PenggunaanController::class, 'create'])->name('penggunaan.create');
    // Route::resource('/penggunaan', PenggunaanController::class);
    Route::get('/laporan',[LaporanController::class,'index'])->name('laporan.index');
    Route::get('/laporan-search',[LaporanController::class,'search']);
    Route::get('/laporan/tagihan/search',[LaporanController::class,'SearchTagihan']);
    Route::get('/laporan/tagihan/print',[LaporanController::class,'TagihanPrint']);
    Route::get('/laporan/print',[LaporanController::class,'print']);
    Route::get('/search',[PelangganController::class,'search']);
    Route::resource('/tagihan', TagihanController::class);

    route::resource('/konfirmasi-pembayaran',KonfirmasiPembayaranController::class)->middleware('isbank');
});

Route::middleware(['auth:pelanggan', 'verified'])->group(function () {
    Route::resource('/beranda', BerandaController::class);
   
    Route::get('/tagihan-pelanggan',[TagihanPelangganController::class,'index'])->name('tagihan.pelanggan');
    Route::resource('/pembayaran', PembayaranController::class);
    // Route::get('/pembayaran/{id}/create',[PembayaranController::class,'create'])->name('pembayaran.create');
});



require __DIR__.'/auth.php';
