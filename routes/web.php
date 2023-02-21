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
Route::prefix('admin')->middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/', [HomeController::class, 'admin'])->name('admin');
    // user
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('user/password/{user}', [UserController::class, 'password'])->name('user.password');
    Route::delete('user/destroy/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    // nasabah
    Route::get('nasabah', [NasabahController::class, 'index'])->name('nasabah.index');
    Route::get('nasabah/create', [NasabahController::class, 'create'])->name('nasabah.create');
    Route::post('nasabah/store', [NasabahController::class, 'store'])->name('nasabah.store');
    Route::get('nasabah/edit/{user}', [NasabahController::class, 'edit'])->name('nasabah.edit');
    Route::post('nasabah/update/{user}', [NasabahController::class, 'update'])->name('nasabah.update');
    Route::post('nasabah/password/{user}', [NasabahController::class, 'password'])->name('nasabah.password');
    Route::delete('nasabah/destroy/{user}', [NasabahController::class, 'destroy'])->name('nasabah.destroy');
});
