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
        Schema::create('hasil_uji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->unique()->constrained('pendaftaran')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users'); // Penguji yang bertanggung jawab

            // --- 1. Pemeriksaan Visual (Kondisi Fisik) ---
            // Menggunakan boolean: true = baik, false = rusak/tidak ada
            $table->boolean('kondisi_ban')->default(true);
            $table->boolean('kondisi_kaca')->default(true);
            $table->boolean('klakson')->default(true);
            $table->boolean('wiper')->default(true);
            $table->boolean('lampu_sign')->default(true);
            $table->boolean('kedalaman_alur_ban')->default(true);

            // --- 2. Parameter Teknis Terukur (Hasil Alat) ---
            // Emisi: Opasitas (solar) atau CO/HC (bensin)
            $table->decimal('emisi_co', 5, 2)->nullable();
            $table->decimal('emisi_hc', 8, 2)->nullable();
            $table->decimal('emisi_asap_opasitas', 5, 2)->nullable();

            // Rem (Brake Tester)
            $table->decimal('rem_utama_kiri', 8, 2)->comment('Satuan Newton atau kg');
            $table->decimal('rem_utama_kanan', 8, 2);
            $table->decimal('selisih_rem_per_sumbu', 5, 2)->comment('Persentase penyimpangan');
            $table->decimal('rem_parkir', 8, 2)->nullable();

            // Lampu & Kebisingan
            $table->decimal('lampu_utama_kekuatan', 8, 2)->comment('Satuan Candela');
            $table->decimal('lampu_utama_penyimpangan', 5, 2)->comment('Derajat penyimpangan');
            $table->decimal('kebisingan_desibel', 5, 2);

            // Side Slip (Kuncup Roda Depan)
            $table->decimal('side_slip', 5, 2)->comment('mm per meter');

            // --- 3. Kesimpulan Akhir ---
            $table->enum('hasil_akhir', ['lulus', 'tidak_lulus']);
            $table->date('masa_berlaku_sampai'); // Otomatis +6 bulan jika lulus
            $table->text('catatan_perbaikan')->nullable(); // Detail bagian yang harus diperbaiki jika tidak lulus

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_uji');
    }
};
