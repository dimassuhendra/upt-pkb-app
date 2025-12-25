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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            // Relasi ke pendaftaran (Satu pendaftaran hanya boleh memberi 1 rating)
            $table->foreignId('pendaftaran_id')->unique()->constrained('pendaftaran')->onDelete('cascade');

            // Menambahkan relasi ke petugas untuk memudahkan laporan performa petugas
            $table->foreignId('petugas_id')->nullable()->constrained('users');

            // Detail Penilaian
            $table->unsignedTinyInteger('skor_bintang'); // 1-5
            $table->enum('kategori_keluhan', ['pelayanan', 'kecepatan', 'fasilitas', 'lainnya'])->nullable();
            $table->text('komentar')->nullable();

            // Keamanan & Privasi
            $table->boolean('tampilkan_publik')->default(true); // Opsi untuk anonimitas atau moderasi
            $table->string('ip_address', 45)->nullable(); // Mencegah spam rating

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
