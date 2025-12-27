<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\HasilUjiController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\LaporanController;

use App\Http\Controllers\Petugas\DashboardController;
use App\Http\Controllers\Petugas\PemeriksaanController;

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
        Route::get('/rekap-hasil', [HasilUjiController::class, 'hasil_uji'])->name('hasil-uji.index');
        Route::get('/rekap-hasil/cetak/{id}', [HasilUjiController::class, 'cetakPdf'])->name('hasil-uji.cetak');
        Route::get('/riwayat-uji', [HasilUjiController::class, 'riwayat'])->name('riwayat.index');

        // Master Data
        Route::resource('pemilik', PemilikController::class);
        Route::resource('kendaraan', KendaraanController::class)->names('kendaraan');
        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::post('/petugas', [PetugasController::class, 'store'])->name('petugas.store');
        Route::patch('/petugas/{id}/toggle', [PetugasController::class, 'toggleStatus'])->name('petugas.toggle');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');
        Route::patch('/petugas/{id}/update-pos', [PetugasController::class, 'updatePos'])->name('petugas.updatePos');

        // Evaluasi
        Route::get('/laporan-periodik', [LaporanController::class, 'index'])->name('laporan.index');
    });

    /**
     * Grouping Petugas
     * Folder View: resources/views/petugas/
     */
    Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {

        // 1. Dashboard & Profil
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');

        // 2. Antrean Kendaraan (Daftar tunggu untuk semua pos)
        Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean');

        // 3. Route Form Input Berdasarkan Pos
        // Pos 1: Visual
        Route::prefix('visual')->name('visual.')->group(function () {
            Route::get('/', [PemeriksaanController::class, 'visualIndex'])->name('index');
            Route::post('/store', [PemeriksaanController::class, 'visualStore'])->name('store');
        });

        // Pos 2: Emisi
        Route::prefix('emisi')->name('emisi.')->group(function () {
            Route::get('/', [PemeriksaanController::class, 'emisiIndex'])->name('index');
            Route::post('/store', [PemeriksaanController::class, 'emisiStore'])->name('store');
        });

        // Pos 3: Rem
        Route::prefix('rem')->name('rem.')->group(function () {
            Route::get('/', [PemeriksaanController::class, 'remIndex'])->name('index');
            Route::post('/store', [PemeriksaanController::class, 'remStore'])->name('store');
        });

        // Pos 4: Lampu & Kebisingan
        Route::prefix('lampu')->name('lampu.')->group(function () {
            Route::get('/', [PemeriksaanController::class, 'lampuIndex'])->name('index');
            Route::post('/store', [PemeriksaanController::class, 'lampuStore'])->name('store');
        });

        // Pos 5: Kuncup Roda & Hasil Akhir
        Route::prefix('roda')->name('roda.')->group(function () {
            Route::get('/', [PemeriksaanController::class, 'rodaIndex'])->name('index');
            Route::post('/store', [PemeriksaanController::class, 'rodaStore'])->name('store');
        });

        // 4. Riwayat & Detail
        Route::get('/riwayat', [PemeriksaanController::class, 'riwayat'])->name('riwayat');
        Route::get('/pemeriksaan/detail/{id}', [PemeriksaanController::class, 'show'])->name('detail');

    });
});