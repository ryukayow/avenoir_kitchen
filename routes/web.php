<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganMenuController;
use App\Http\Controllers\PelangganPesananController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminMejaController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\KokiPesananController;

Route::get('/', function () {
    return view('landing.index');
})->name('landing.index');

Route::get('/menu/{id_meja}', [PelangganMenuController::class, 'index']);
Route::post('/pesan', [PelangganPesananController::class, 'store']);
Route::get('/tracking/{nomor_pesanan}', [PelangganPesananController::class, 'tracking']);

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', [AdminMenuController::class, 'dashboard']);
Route::resource('/admin/menu', AdminMenuController::class);
Route::resource('/admin/meja', AdminMejaController::class);
Route::get('/admin/pesanan', [AdminPesananController::class, 'index']);
Route::post('/admin/pesanan/bayar/{id_pesanan}', [AdminPesananController::class, 'prosesPembayaran']);
Route::post('/admin/pesanan/selesai/{id_pesanan}', [AdminPesananController::class, 'selesai']);

Route::get('/koki/kitchen', [KokiPesananController::class, 'index']);
Route::post('/koki/kitchen/mulai/{id_pesanan}', [KokiPesananController::class, 'mulaiMasak']);
Route::post('/koki/kitchen/selesai/{id_pesanan}', [KokiPesananController::class, 'selesai']);