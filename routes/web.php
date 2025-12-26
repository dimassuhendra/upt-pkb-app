<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\PetugasController;

use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [SurveiController::class, 'index'])->name('survei.index');
Route::post('/survei/simpan', [SurveiController::class, 'store'])->name('survei.store');

/*
|--------------------------------------------------------------------------
| Guest Routes (Halaman Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login Admin (Mengarah ke login.blade.php)
    Route::get('/login-admin', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login-admin', [AuthController::class, 'login']);

    // Login Petugas (Mengarah ke login-petugas.blade.php)
    Route::get('/login-petugas', [AuthController::class, 'showPetugasLogin'])->name('petugas.login');
    Route::post('/login-petugas', [AuthController::class, 'petugasLogin']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Route Logout Global
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /**
     * Grouping Admin
     * Folder View: resources/views/admin/
     */
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        // Transaksi dan Operasional
        Route::get('/pendaftaran/baru', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran/simpan', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean.index');
        Route::post('/antrean/{id}/next', [AntreanController::class, 'updateStatus'])->name('antrean.next');

        // Master Data
        Route::resource('pemilik', PemilikController::class);
        Route::resource('kendaraan', KendaraanController::class)->names('kendaraan');
        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
        Route::patch('/petugas/{id}/toggle', [PetugasController::class, 'toggleStatus'])->name('petugas.toggle');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
        Route::patch('/petugas/{id}/update-pos', [PetugasController::class, 'updatePos'])->name('petugas.updatePos');
    });

    /**
     * Grouping Petugas
     * Folder View: resources/views/petugas/
     */
    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

        // Anda bisa menambahkan route khusus petugas lainnya di sini nanti
    });
});