<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    // 1. Kasih tahu nama tabelnya (biar nggak nyasar)
    protected $table = 'buses';

    // 2. Daftarkan kolom yang boleh diisi (Fillable)
    protected $fillable = [
        'bus_name',    // Bukan nama_bus
        'type',        // Bukan tipe
        'total_seats', // Bukan kapasitas
    ];

    // 3. Relasi ke Schedule (Satu bus punya banyak jadwal)
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}