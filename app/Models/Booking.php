<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Pastikan ini sama persis dengan yang ada di migration kamu
    protected $fillable = [
        'schedule_id',
        'user_id',
        'seat_number',
        'total_price',
        'payment_method',
        'payment_status',
        'paid_at',
        'booking_status',
    ];

    // Relasi ke Jadwal (Satu booking punya satu jadwal)
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // Relasi ke User (Satu booking milik satu penumpang/user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}