<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kredits', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengajuan')->unique();
            $table->foreignId('nasabah_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_kredit', ['KUR', 'KPR', 'Kredit Usaha', 'Kredit Konsumtif']);
            $table->decimal('jumlah_pengajuan', 15, 2);
            $table->integer('jangka_waktu'); // dalam bulan
            $table->decimal('bunga', 5, 2); // persen
            $table->text('tujuan_pengajuan');
            $table->enum('status', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->text('catatan')->nullable();
            $table->date('tanggal_pengajuan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kredits');
    }
};