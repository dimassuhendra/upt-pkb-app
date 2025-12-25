<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();

            // Relasi Utama
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade');
            $table->foreignId('petugas_id')->nullable()->constrained('users'); // Petugas yang mendaftarkan atau memeriksa

            // Identitas Pendaftaran
            $table->string('kode_pendaftaran')->unique(); // Contoh: REG-20231027-001
            $table->date('tgl_daftar');
            $table->string('nomor_antrean', 10);

            // Kategori & Tujuan
            // Menentukan apakah ini uji baru, perpanjangan berkala, atau mutasi
            $table->enum('jenis_pendaftaran', ['baru', 'berkala', 'numpang_uji', 'mutasi']);

            // Keuangan (Status Pembayaran)
            $table->integer('total_biaya')->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'qris'])->nullable();
            $table->enum('status_pembayaran', ['pending', 'lunas', 'batal'])->default('pending');
            $table->timestamp('tgl_bayar')->nullable();

            // Operasional (Status Uji)
            $table->enum('status_uji', ['menunggu', 'proses', 'lulus', 'tidak_lulus', 'batal'])->default('menunggu');

            // Catatan & Hasil
            $table->text('catatan_petugas')->nullable(); // Alasan jika tidak lulus atau catatan tambahan
            $table->string('foto_kendaraan')->nullable(); // Bukti kendaraan hadir di lokasi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
