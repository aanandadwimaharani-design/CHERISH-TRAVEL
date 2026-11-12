<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking', 30)->unique();
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->string('nama_pemesan');
            $table->string('email');
            $table->string('nomor_hp');
            $table->integer('jumlah_penumpang');
            $table->decimal('total_harga', 15, 2);
            $table->string('status_pemesanan')->default('Terkonfirmasi'); // 'Terkonfirmasi', 'Lunas', 'Dibatalkan'
            $table->string('tipe_perjalanan')->default('Sekali Jalan'); // 'Sekali Jalan', 'Pulang-Pergi'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
