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
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id');
            $table->enum('status', ['confirmed', 'shipped']);
            $table->string('dokumen');
            $table->string('nr');
            $table->date('tanggal');
            $table->date('realisasi');
            $table->date('tanggal_awal');
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
