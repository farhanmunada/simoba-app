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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mobil_id');
            $table->unsignedBigInteger('bidang_id');
            $table->string('nama_acara');
            $table->string('penanggung_jawab');
            $table->string('tempat_kegiatan');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai');
            $table->timestamps();

            $table->foreign('mobil_id')->references('id')->on('mobil')->onDelete('cascade');
            $table->foreign('bidang_id')->references('id')->on('bidang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
