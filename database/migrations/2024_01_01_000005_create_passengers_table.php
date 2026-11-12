<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin', 20); // 'Laki-laki', 'Perempuan'
            $table->date('tanggal_lahir');
            $table->string('nomor_identitas', 50);
            $table->string('nomor_kursi', 10)->nullable();
            $table->string('bagasi_tambahan')->default('0 kg');
            $table->decimal('biaya_bagasi', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};
