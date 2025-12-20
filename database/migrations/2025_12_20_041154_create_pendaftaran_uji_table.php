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
        Schema::create('pendaftaran_uji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')->constrained('kendaraan');
            $table->string('nomor_antrean');
            $table->date('tgl_uji');
            $table->integer('biaya_retribusi');
            $table->enum('status_kelulusan', ['proses', 'lulus', 'tidak_lulus'])->default('proses');
            $table->date('masa_berlaku_kir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_uji');
    }
};
