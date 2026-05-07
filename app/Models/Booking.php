<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Daftarkan semua kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'schedule_id',
        'seat_number',
        'total_price',
        'payment_status',
        'booking_status',
        'payment_method'
    ];
}