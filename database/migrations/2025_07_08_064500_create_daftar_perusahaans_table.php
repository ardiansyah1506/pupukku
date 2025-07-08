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
        Schema::create('daftar_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('perusahaan');
            $table->string('username');
            $table->string('password');
            $table->string('bukti_bayar');
            $table->string('norek');
            $table->string('jenis_bank');
            $table->enum('status',['1','0']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_perusahaans');
    }
};
