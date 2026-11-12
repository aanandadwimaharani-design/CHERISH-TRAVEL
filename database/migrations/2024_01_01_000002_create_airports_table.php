<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bandara', 10)->unique();
            $table->string('nama_bandara');
            $table->string('kota');
            $table->string('negara');
            $table->string('tipe', 20)->default('domestik'); // 'domestik' atau 'internasional'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
