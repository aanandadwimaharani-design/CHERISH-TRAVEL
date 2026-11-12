<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Passenger extends Model
{
    use HasFactory;

    protected $table = 'passengers';

    protected $fillable = [
        'booking_id',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'nomor_identitas',
        'nomor_kursi',
        'bagasi_tambahan',
        'biaya_bagasi',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'biaya_bagasi' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function getFormattedTanggalLahirAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->translatedFormat('d F Y');
    }
}
