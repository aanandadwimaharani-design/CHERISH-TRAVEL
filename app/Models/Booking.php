<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'kode_booking',
        'flight_id',
        'nama_pemesan',
        'email',
        'nomor_hp',
        'jumlah_penumpang',
        'total_harga',
        'status_pemesanan',
        'tipe_perjalanan',
    ];

    protected $casts = [
        'total_harga' => 'decimal:2',
        'jumlah_penumpang' => 'integer',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id');
    }

    public function passengers()
    {
        return $this->hasMany(Passenger::class, 'booking_id');
    }

    public function getFormattedTotalHargaAttribute()
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    /**
     * Generate Kode Booking Unik
     */
    public static function generateKodeBooking()
    {
        do {
            $code = 'CT-' . strtoupper(Str::random(6));
        } while (self::where('kode_booking', $code)->exists());

        return $code;
    }
}
