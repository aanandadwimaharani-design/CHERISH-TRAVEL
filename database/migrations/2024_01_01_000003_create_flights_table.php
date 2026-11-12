<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->foreignId('airport_origin_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('airport_destination_id')->constrained('airports')->onDelete('cascade');
            $table->string('nomor_penerbangan');
            $table->date('tanggal_keberangkatan');
            $table->time('jam_keberangkatan');
            $table->date('tanggal_kedatangan');
            $table->time('jam_kedatangan');
            $table->string('durasi');
            $table->string('tipe_penerbangan')->default('Langsung'); // 'Langsung' atau 'Transit'
            $table->string('kelas_penerbangan')->default('Ekonomi'); // 'Ekonomi', 'Bisnis', 'First Class'
            $table->decimal('harga', 15, 2);
            $table->integer('kapasitas_kursi');
            $table->string('status')->default('Tersedia'); // 'Tersedia', 'Penuh', 'Dibatalkan'
            $table->string('terminal')->nullable()->default('Terminal 1');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
