<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ganti_oli', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mobil');
            $table->date('tanggal_ganti');
            $table->integer('km_saat_ganti');
            $table->integer('km_target_berikutnya');
            $table->text('catatan')->nullable();
            $table->string('petugas_input');
            $table->timestamps();

            $table->foreign('id_mobil')->references('id')->on('mobil')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ganti_oli');
    }
};
