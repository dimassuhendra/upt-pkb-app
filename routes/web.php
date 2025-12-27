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
use App\Http\Controllers\Petugas\AntreanController as PetugasAntreanController;
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

        // 1. Dashboard & Antrean
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/antrean', [PetugasAntreanController::class, 'index'])->name('antrean');

        // 2. Route Input Pemeriksaan (Semua menggunakan ID Pendaftaran)
        // Gunakan prefix yang jelas agar request()->is('petugas/visual*') di sidebar berfungsi
        Route::get('/visual/{id}', [PemeriksaanController::class, 'visualIndex'])->name('visual.index');
        Route::get('/emisi/{id}', [PemeriksaanController::class, 'emisiIndex'])->name('emisi.index');
        Route::get('/rem/{id}', [PemeriksaanController::class, 'remIndex'])->name('rem.index');
        Route::get('/lampu/{id}', [PemeriksaanController::class, 'lampuIndex'])->name('lampu.index');
        Route::get('/roda/{id}', [PemeriksaanController::class, 'rodaIndex'])->name('roda.index');

        // 3. Route Simpan (Satu endpoint untuk semua POST dari berbagai POS)
        Route::post('/pemeriksaan/store/{id}', [PemeriksaanController::class, 'store'])->name('store');
        Route::get('/pemeriksaan/detail/{id}', [PemeriksaanController::class, 'show'])->name('detail');

        // 4. Riwayat & Lainnya
        Route::get('/riwayat', [PemeriksaanController::class, 'riwayat'])->name('riwayat');
        Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');

    });
});