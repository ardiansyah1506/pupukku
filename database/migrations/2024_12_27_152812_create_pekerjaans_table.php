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
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('kendaraan');
            $table->string('no_pol');
            $table->string('alamat');
            $table->string('lokasi');
            $table->integer('total_karung');
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
        Schema::dropIfExists('pekerjaan');
    }
};
