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
        Schema::create('pengajuan_gaji', function (Blueprint $table) {
            $table->id();
            $table->string('bank');
            $table->integer('no_rekening');
            $table->string('nama');
            $table->integer('total_pengajuan');
            $table->string('file')->nullable();
            $table->string('id_daftar_gaji');
            $table->integer('id_perusahaan');
            $table->boolean('status')->default(0); // 0 = inactive, 1 = active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_gaji');
    }
};
