<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\AdminController;
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
    return redirect()->to('login');
});



// Auth
Route::get('/login', [AuthController::class, 'view_login']);
Route::get('/register', [AuthController::class, 'view_register']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgotpw', [AuthController::class, 'forgotpw']);


// User
Route::group(['middleware' => ['login_user']], function() {
    Route::get('/user-dashboard', [AuthController::class, 'index']);
    Route::get('/pemesanan', [PemesananController::class, 'pemesanan']);
    Route::post('/pemesanan', [PemesananController::class, 'store']);
    Route::get('/pembayaran', [TransaksiController::class, 'pembayaran']);
    Route::post('/pembayaran', [TransaksiController::class, 'store']);
    Route::get('/riwayat-transaksi', [TransaksiController::class, 'riwayat_transaksi']);
    Route::post('/getPemesanan', [TransaksiController::class, 'getPemesanan']);
    Route::get('ubah-password-user', [AuthController::class, 'ubah_password']);
    Route::post('update-password-user/{id}', [AuthController::class, 'update_password']);
});

// Admin
Route::group(['middleware' => ['login_admin']], function() {
    Route::get('/admin-dashboard', [AdminController::class, 'index']);
    Route::get('/laporan', [LaporanController::class, 'laporan']);
    Route::get('/laporan-cetak', [LaporanController::class, 'laporan_cetak']);
    Route::get('/supir', [AdminController::class, 'supir']);
    Route::post('/supir/update/{id}', [AdminController::class, 'update_supir']);
    Route::get('/tujuan', [TujuanController::class, 'index']);
    Route::post('/tujuan/tambah', [TujuanController::class, 'store']);
    Route::post('/tujuan/update/{id}', [TujuanController::class, 'update']);
    Route::get('/tujuan/delete/{id}', [TujuanController::class, 'destroy']);
    Route::get('/pengguna', [AdminController::class, 'view_pengguna']);
    Route::post('/pengguna/tambah', [AdminController::class, 'tambah_pengguna']);
    Route::post('/pengguna/update/{id}', [AdminController::class, 'update_pengguna']);
    Route::get('/pengguna/delete/{id}', [AdminController::class, 'delete_pengguna']);
    Route::get('ubah-password-admin', [AdminController::class, 'ubah_password']);
    Route::post('update-password-admin/{id}', [AdminController::class, 'update_password']);
});

// Supir
Route::group(['middleware' => ['login_supir']], function() {
    Route::get('/supir-dashboard', [SupirController::class, 'index']);
    Route::get('/pemesanan-pengguna', [SupirController::class, 'pemesanan']);
    Route::get('/pembayaran-pengguna', [SupirController::class, 'pembayaran']);
    Route::get('/update-status-pemesanan/{id}', [SupirController::class, 'update_status']);
    Route::get('ubah-password-supir', [AdminController::class, 'ubah_password']);
    Route::get('ubah-password-supir', [SupirController::class, 'ubah_password']);
    Route::post('update-password-supir/{id}', [SupirController::class, 'update_password']);
    Route::get('pembayaran/cetak/{id}', [SupirController::class, 'cetak_pembayaran']);
});

Route::get('/logout', [AuthController::class, 'logout']);