<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen_nasabahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained()->onDelete('cascade');
            $table->string('jenis_dokumen'); // KTP, KK, NPWP, Slip Gaji, dll
            $table->string('nama_file');
            $table->string('file_path');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_upload');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen_nasabahs');
    }
};