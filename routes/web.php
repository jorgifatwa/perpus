<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\BukuKeluarController;
use App\Http\Controllers\BukuMasukController;

Route::get('/',[AuthController::class,'index'])->name('login');

Auth::routes();

//buat konfigurasi prefix URL menjadi admin dan harus login untuk mengakses data dibawah
Route::group(['prefix'=>'admin','middleware' => ['auth']], function () {
    // anggota
    Route::resource('anggota',AnggotaController::class); 
    
    // book
    Route::resource('book',BookController::class);
      
    // pinjam
    Route::resource('pinjam',PinjamController::class);

    // kembali
    Route::resource('kembali',KembaliController::class);

    // kelas
    Route::resource('kelas',KelasController::class);

    // buku_masuk
    Route::resource('buku_masuk',BukuMasukController::class);

    // buku_keluar
    Route::resource('buku_keluar',BukuKeluarController::class);
   
});

Route::get('/',[AuthController::class,'index'])->name('login');
Route::get('login',[AuthController::class,'index'])->name('login');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

Route::post('proses_login',[AuthController::class,'proses_login'])->name('proses.login');
Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses.register');

Route::post('logout',[AuthController::class,'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('pinjam/getPinjamId',[PinjamController::class,'getPinjamId'])->name('pinjam.getPinjamId');
Route::get('anggota/getAnggotaById',[AnggotaController::class,'getAnggotaById'])->name('anggota.getAnggotaById');
Route::get('book/getPriceById', [BookController::class,'getPriceById'])->name('book.getPriceById');

Route::get('/pinjam/kembalikan/{id}', [PinjamController::class, 'kembalikan'])->name('pinjam.kembalikan');