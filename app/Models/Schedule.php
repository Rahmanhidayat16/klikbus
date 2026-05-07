<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'bus_id',
        'departure_time',
        'arrival_time',
        'status',
    ];

    // Relasi ke Bus: Jadwal ini milik bus mana?
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // Relasi ke Route: Jadwal ini rutenya ke mana?
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}