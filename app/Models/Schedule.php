<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;



    // Tambahkan ini! Ini adalah daftar "pintu" yang boleh diisi

    protected $fillable = [
        'bus_id',
        'route_id',
        'departure_time',
        'arrival_time',
        'status',
    ];


    // 1. Kasih tahu Laravel kalau Schedule ini punya (belongsTo) Bus

    // Relasi ke Bus

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }


    // 2. Kasih tahu Laravel kalau Schedule ini punya (belongsTo) Route

    // Relasi ke Route

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}