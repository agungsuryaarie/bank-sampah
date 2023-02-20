<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KeuanganController;

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



// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
// user
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('create', [UserController::class, 'create'])->name('user.create');
Route::get('edit', [UserController::class, 'edit'])->name('user.edit');


// nasabah
Route::get('nasabah', [NasabahController::class, 'index'])->name('nasabah.index');

// jenis sampah
Route::get('jenissampah', [JenisController::class, 'index'])->name('jenis.index');

// catatan
Route::get('catatan', [CatatanController::class, 'index'])->name('catatan.index');

// penjualan
Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');

// keuangan
Route::get('keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');


Auth::routes();

/*------------------------------------------
--------------------------------------------
All Nasabah Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:nasabah'])->group(function () {

    Route::get('/nasabah', [HomeController::class, 'index'])->name('nasabah');
});

/*------------------------------------------
--------------------------------------------
All Pengurus Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:pengurus'])->group(function () {

    Route::get('/pengurus', [HomeController::class, 'pengurus'])->name('pengurus');
});

/*------------------------------------------
--------------------------------------------
All Bendahara Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:bendahara'])->group(function () {

    Route::get('/bendahara', [HomeController::class, 'bendahara'])->name('bendahara');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
});
