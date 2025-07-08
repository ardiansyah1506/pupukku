<?php

use App\Http\Controllers\DaftarPerusahaanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PekerjaanAktifController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\RiwayatPenarikanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/', [LoginController::class, 'index']);
Route::get('/register', [LoginController::class, 'showRegisterForm']);
Route::post('/', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['prefix' => '/daftar', 'as' => 'daftar.', 'controller' => DaftarPerusahaanController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/detil/{id}', 'detail')->name('detail');
    Route::get('/create/{id}', 'create')->name('create');
    Route::get('/admin/{id}', 'admin')->name('admin');
    Route::post('/store', 'store')->name('store');
    Route::post('/uploadBuktiBayar/{id}', 'uploadBuktiBayar')->name('uploadBuktiBayar');
    Route::post('/konfirmasi/{id}', 'konfirmasi')->name('konfirmasi');
});

// Optional: Add this route for AJAX detail fetching
Route::get('/daftar/detail/{id}', function($id) {
    $perusahaan = \App\Models\DaftarPerusahaan::findOrFail($id);
    return response()->json($perusahaan);
})->name('daftar.detail.ajax');
Route::middleware('auth')->group(function(){
    Route::group(['prefix' => '/riwayat-penarikan', 'as' => 'RiwayatPenarikan.', 'controller' => RiwayatPenarikanController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/daftar', 'DaftarGaji')->name('DaftarGaji');
        Route::post('/bayar', 'bayar')->name('bayar');
        Route::get('/{id}', 'show')->name('show');
    });
    Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.', 'controller' => DashboardController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::post('/PengajuanGaji', 'PengajuanGaji')->name('PengajuanGaji');
    });
    Route::group(['prefix' => '/manajemen-user', 'as' => 'user.', 'controller' => UserController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
    });
  
    Route::group(['prefix' => '/pekerjaan', 'as' => 'pekerjaan.', 'controller' => PekerjaanController::class], function () {
        Route::get('/form', 'index')->name('index');
        Route::get('/daftar-pekerjaan', 'DaftarPekerjaanBaru')->name('DaftarPekerjaanBaru');
        Route::post('/ambil-pekerjaan', 'ambilPekerjaan')->name('ambilPekerjaan');
        Route::post('/store', 'store')->name('store');
    });

    Route::group(['prefix' => '/pekerjaan-aktif', 'as' => 'pekerjaanAktif.', 'controller' => PekerjaanAktifController::class], function () {
        Route::get('/', 'index')->name('index');
    });
    Route::group(['prefix' => '/laporan', 'as' => 'laporan.', 'controller' => LaporanController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('detail-karyawan/{id}', 'showDetailKaryawan')->name('showDetailKaryawan');
        Route::get('detail-karyawan', 'daftarKaryawan')->name('daftarKaryawan');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/store', 'store')->name('store');
    });
});


