<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\KendaraanController;
// Import controller dashboard untuk petugas
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
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Login Petugas (Mengarah ke login-petugas.blade.php)
    Route::get('/petugas/login', [AuthController::class, 'showPetugasLogin'])->name('petugas.login');
    Route::post('/petugas/login', [AuthController::class, 'petugasLogin']);
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

        // Fitur Pendaftaran
        Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

        // Master Data (Resource CRUD)
        Route::resource('pemilik', PemilikController::class);
        Route::resource('data-kendaraan', KendaraanController::class);
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