<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PenarikanController;
use App\Http\Controllers\SampahController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Auth\RegisterController;

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



// // Login
Route::get('/', [DashboardController::class, 'login'])->name('/');
Route::post('/masuk', [LoginController::class, 'login'])->name('masuk');

Auth::routes();

Route::post('customer/create', [RegisterController::class, 'create'])->name('customer.create');

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('admin')->middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('dashboard/data', [HomeController::class, 'getData'])->name('admin.dashboard.data');
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
    Route::get('transaksi/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    Route::post('transaksi/{transaksi}/update', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::delete('transaksi/{transaksi}/destroy', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');
});

/*------------------------------------------
--------------------------------------------
All Pengurus Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('pengurus')->middleware(['auth', 'user-access:pengurus'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('pengurus.dashboard');
    Route::get('dashboard/data', [HomeController::class, 'getData'])->name('admin.dashboard.data');

    // nasabah
    Route::get('nasabah', [NasabahController::class, 'index'])->name('pengurus.nasabah.index');
    Route::get('nasabah/show/{user}', [NasabahController::class, 'show'])->name('pengurus.nasabah.show');

    // sampah
    Route::get('sampah', [SampahController::class, 'index'])->name('pengurus.sampah.index');

    // transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('pengurus.transaksi.index');
    Route::get('transaksi/{id}/sampah', [TransaksiController::class, 'getSampah'])->name('pengurus.transaksi.getSampah');
    Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('pengurus.transaksi.store');
    Route::get('transaksi/{transaksi}/edit', [TransaksiController::class, 'edit'])->name('pengurus.transaksi.edit');
    Route::post('transaksi/{transaksi}/update', [TransaksiController::class, 'update'])->name('pengurus.transaksi.update');
    Route::delete('transaksi/{transaksi}/destroy', [TransaksiController::class, 'destroy'])->name('pengurus.transaksi.destroy');
});

/*------------------------------------------
--------------------------------------------
All Bendahara Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('bendahara')->middleware(['auth', 'user-access:bendahara'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('bendahara.dashboard');
    Route::get('dashboard/data', [HomeController::class, 'getData'])->name('admin.dashboard.data');

    // nasabah
    Route::get('nasabah', [NasabahController::class, 'index'])->name('bendahara.nasabah.index');
    Route::get('nasabah/show/{user}', [NasabahController::class, 'show'])->name('bendahara.nasabah.show');

    // sampah
    Route::get('sampah', [SampahController::class, 'index'])->name('bendahara.sampah.index');

    // transaksi
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('bendahara.transaksi.index');

    // penarikan
    Route::get('penarikan', [PenarikanController::class, 'bendahara'])->name('bendahara.penarikan');
    Route::post('penarikan/update/{penarikan}', [PenarikanController::class, 'aksi'])->name('bendahara.penarikan.update');
    Route::post('penarikan/update/tanggal/{penarikan}', [PenarikanController::class, 'updateTanggal'])->name('bendahara.penarikan.tanggal');
});

/*------------------------------------------
--------------------------------------------
All Nasabah Routes List
--------------------------------------------
--------------------------------------------*/
Route::prefix('nasabah')->middleware(['auth', 'user-access:nasabah'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'nasabah'])->name('nasabah.dashboard');

    // penarikan
    Route::get('penarikan', [PenarikanController::class, 'index'])->name('nasabah.penarikan');
    Route::post('penarikan/store', [PenarikanController::class, 'store'])->name('nasabah.penarikan.store');
    Route::post('penarikan/update/{penarikan}', [PenarikanController::class, 'update'])->name('nasabah.penarikan.update');
    Route::delete('penarikan/destroy/{penarikan}', [PenarikanController::class, 'destroy'])->name('nasabah.penarikan.destroy');

    // history
    Route::get('hispenjualan', [HistoryController::class, 'hispenjualan'])->name('nasabah.hispenjualan');
    Route::get('hispenarikan', [HistoryController::class, 'hispenarikan'])->name('nasabah.hispenarikan');
});
