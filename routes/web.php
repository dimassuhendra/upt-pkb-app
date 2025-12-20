<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\PemilikController;



Route::get('/', [SurveiController::class, 'index'])->name('survei.index');
Route::post('/survei/simpan', [SurveiController::class, 'store'])->name('survei.store');


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes (Hanya bisa diakses jika sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Grouping Admin dengan Name Prefix 'admin.'
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        // Route Resource ini otomatis akan punya nama: admin.pemilik.index, admin.pemilik.store, dll.
        Route::resource('pemilik', PemilikController::class);
    });
});