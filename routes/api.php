<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PinjamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// konfigurasi URL untuk API
Route::get('pinjam/getPinjamId',[PinjamController::class,'getPinjamId'])->name('pinjam.getPinjamId');
Route::get('anggota/getAnggotaById',[AnggotaController::class,'getAnggotaById'])->name('anggota.getAnggotaById');
Route::get('book/getPriceById', [BookController::class,'getPriceById'])->name('book.getPriceById');