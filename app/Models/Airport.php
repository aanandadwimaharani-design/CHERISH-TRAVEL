<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $table = 'airports';

    protected $fillable = [
        'kode_bandara',
        'nama_bandara',
        'kota',
        'negara',
        'tipe',
    ];

    public function flightsOrigin()
    {
        return $this->hasMany(Flight::class, 'airport_origin_id');
    }

    public function flightsDestination()
    {
        return $this->hasMany(Flight::class, 'airport_destination_id');
    }

    /**
     * Tampilan lengkap Bandara untuk Dropdown
     */
    public function getLabelAttribute()
    {
        return "{$this->kota} ({$this->kode_bandara}) - {$this->nama_bandara}";
    }
}
