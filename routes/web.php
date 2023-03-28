<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiController;

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



// Login
Route::get('/', [DashboardController::class, 'login']);



Auth::routes();


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('admin')->middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    // user
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('user/password/{user}', [UserController::class, 'password'])->name('user.password');
    Route::delete('user/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // nasabah
    Route::get('nasabah', [NasabahController::class, 'index'])->name('admin.nasabah.index');
    Route::get('nasabah/show/{user}', [NasabahController::class, 'show'])->name('admin.nasabah.show');
    Route::get('nasabah/create', [NasabahController::class, 'create'])->name('nasabah.create');
    Route::post('nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::get('nasabah/edit/{user}', [NasabahController::class, 'edit'])->name('nasabah.edit');
    Route::post('nasabah/update/{user}', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::post('nasabah/password/{user}', [NasabahController::class, 'password'])->name('nasabah.password');
    Route::delete('nasabah/destroy/{user}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');

    // sampah
    Route::get('sampah', [SampahController::class, 'index'])->name('admin.sampah.index');
    Route::post('sampah/store', [SampahController::class, 'store'])->name('sampah.store');
    Route::post('sampah/update/{sampah}', [SampahController::class, 'update'])->name('sampah.update');
    Route::delete('sampah/destroy/{sampah}', [SampahController::class, 'destroy'])->name('sampah.destroy');

    // transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('transaksi/{id}/sampah', [TransaksiController::class, 'getSampah'])->name('admin.transaksi.getSampah');
    Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    Route::post('transaksi/update/{transaksi}', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::delete('transaksi/{transaksi}/destroy', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
});

/*------------------------------------------
--------------------------------------------
All Pengurus Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('pengurus')->middleware(['auth', 'user-access:pengurus'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'pengurus'])->name('pengurus.dashboard');

    // nasabah
    Route::get('nasabah', [NasabahController::class, 'index'])->name('pengurus.nasabah.index');
    Route::get('nasabah/show/{user}', [NasabahController::class, 'show'])->name('pengurus.nasabah.show');

    // sampah
    Route::get('sampah', [SampahController::class, 'index'])->name('pengurus.sampah.index');

    // transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('pengurus.transaksi.index');
    Route::get('transaksi/{id}/sampah', [TransaksiController::class, 'getSampah'])->name('pengurus.transaksi.getSampah');
    Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('pengurus.transaksi.store');
    Route::get('transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('pengurus.transaksi.edit');
    Route::post('transaksi/update/{transaksi}', [TransaksiController::class, 'update'])->name('pengurus.transaksi.update');
    Route::delete('transaksi/{transaksi}/destroy', [TransaksiController::class, 'destroy'])->name('pengurus.transaksi.destroy');
});

/*------------------------------------------
--------------------------------------------
All Bendahara Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('bendahara')->middleware(['auth', 'user-access:bendahara'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'bendahara'])->name('bendahara.dashboard');

    // nasabah
    Route::get('nasabah', [NasabahController::class, 'index'])->name('bendahara.nasabah.index');
    Route::get('nasabah/show/{user}', [NasabahController::class, 'show'])->name('bendahara.nasabah.show');

    // sampah
    Route::get('sampah', [SampahController::class, 'index'])->name('bendahara.sampah.index');

    // transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('bendahara.transaksi.index');
});

/*------------------------------------------
--------------------------------------------
All Nasabah Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('nasabah')->middleware(['auth', 'user-access:nasabah'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'nasabah'])->name('nasabah.dashboard');
    Route::get('transaksi', [HomeController::class, 'transaksi'])->name('nasabah.transaksi');
    Route::get('penjualan', [HomeController::class, 'penjualan'])->name('nasabah.penjualan');
    Route::get('penarikan', [HomeController::class, 'penarikan'])->name('nasabah.penarikan');
});
