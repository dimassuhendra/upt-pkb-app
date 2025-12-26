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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id')->constrained('pemilik')->onDelete('cascade');

            // Identitas Utama
            $table->string('no_kendaraan', 12)->unique(); // Plat Nomor
            $table->string('no_rangka', 25)->unique();
            $table->string('no_mesin', 25)->unique();
            $table->string('no_bpkb', 20)->unique();

            // Spesifikasi Dasar
            $table->string('merek'); // Contoh: Toyota, Mitsubishi, Hino
            $table->string('tipe');  // Contoh: Dyna, Canter, Jetbus 3
            $table->enum('jenis_kendaraan', ['Bus', 'Truk', 'Angkot', 'Pickup', 'Mobil Penumpang']);
            $table->string('model'); // Contoh: Microbus, Dump Truck, Box
            $table->integer('tahun_pembuatan');
            $table->integer('tahun_perakitan');
            $table->integer('isi_silinder'); // Contoh: 2500 (cc)

            // Teknis & Fisik
            $table->string('warna');
            $table->string('warna_tnkb'); // Hitam, Kuning, Merah, Putih
            $table->enum('bahan_bakar', ['Bensin', 'Solar', 'Listrik', 'Hybrid']);
            $table->integer('jumlah_roda');
            $table->integer('jumlah_sumbu'); // Penting untuk klasifikasi jalan

            // Kapasitas & Beban (Khusus Angkutan Barang/Orang)
            $table->integer('kapasitas_penumpang')->default(0);
            $table->integer('berat_kosong')->comment('dalam kg');
            $table->integer('jbb')->comment('Jumlah Berat yang Diperbolehkan dalam kg');
            $table->integer('jbi')->comment('Jumlah Berat yang Diizinkan dalam kg');

            // Status Administrasi
            $table->date('masa_berlaku_stnk');
            $table->date('masa_berlaku_uji_kir')->nullable(); // Untuk angkutan umum/barang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
