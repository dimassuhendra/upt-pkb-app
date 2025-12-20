<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('kendaraan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pemilik_id')->constrained('pemilik')->onDelete('cascade');
        $table->string('no_uji')->unique();
        $table->string('no_kendaraan')->unique();
        $table->string('no_rangka')->unique();
        $table->string('no_mesin')->unique();
        $table->string('merek');
        $table->string('tipe');
        $table->year('tahun_pembuatan');
        $table->string('bahan_bakar');
        $table->integer('jbb');
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
