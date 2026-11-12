<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $fillable = [
        'airline_id',
        'airport_origin_id',
        'airport_destination_id',
        'nomor_penerbangan',
        'tanggal_keberangkatan',
        'jam_keberangkatan',
        'tanggal_kedatangan',
        'jam_kedatangan',
        'durasi',
        'tipe_penerbangan',
        'kelas_penerbangan',
        'harga',
        'kapasitas_kursi',
        'status',
        'terminal',
    ];

    protected $casts = [
        'tanggal_keberangkatan' => 'date',
        'tanggal_kedatangan' => 'date',
        'harga' => 'decimal:2',
        'kapasitas_kursi' => 'integer',
    ];

    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function origin()
    {
        return $this->belongsTo(Airport::class, 'airport_origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(Airport::class, 'airport_destination_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'flight_id');
    }

    /**
     * Hitung sisa kursi tersedia
     */
    public function getSisaKursiAttribute()
    {
        $bookedSeats = $this->bookings()
            ->whereIn('status_pemesanan', ['Terkonfirmasi', 'Lunas'])
            ->sum('jumlah_penumpang');

        $remaining = $this->kapasitas_kursi - $bookedSeats;
        return max(0, $remaining);
    }

    /**
     * Format harga ke Rupiah
     */
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Jam keberangkatan format HH:mm
     */
    public function getFormattedJamKeberangkatanAttribute()
    {
        return Carbon::parse($this->jam_keberangkatan)->format('H:i');
    }

    /**
     * Jam kedatangan format HH:mm
     */
    public function getFormattedJamKedatanganAttribute()
    {
        return Carbon::parse($this->jam_kedatangan)->format('H:i');
    }

    /**
     * Tanggal keberangkatan dalam bahasa Indonesia
     */
    public function getFormattedTanggalKeberangkatanAttribute()
    {
        return Carbon::parse($this->tanggal_keberangkatan)->translatedFormat('l, d F Y');
    }
}
