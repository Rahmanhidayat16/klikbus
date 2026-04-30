<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin & Penumpang
        User::create([
            'name' => 'Admin KlikBus',
            'email' => 'valeriealanaa@gmail.com',
            'password' => Hash::make('admin123'),
            'phone' => '085783182434',
            'role' => 'admin',
        ]);

        $user = User::create([
            'name' => 'Ledi Daiyana',
            'email' => 'ledi123@gmail.com',
            'password' => Hash::make('user123'),
            'phone' => '085658675592',
            'role' => 'user',
        ]);

        // 2. Buat Data Bus
        $bus1 = Bus::create([
            'bus_name' => 'Puspa Jaya',
            'type' => 'Executive',
            'total_seats' => 40,
        ]);

        $bus2 = Bus::create([
            'bus_name' => 'Raja Basa Utama',
            'type' => 'Ekonomi',
            'total_seats' => 50,
        ]);

        // 3. Buat Data Rute
        $route1 = Route::create([
            'departure' => 'Bandar Lampung',
            'destination' => 'Pringsewu',
            'base_price' => 25000,
        ]);

        $route2 = Route::create([
            'departure' => 'Kota Agung',
            'destination' => 'Metro',
            'base_price' => 50000,
        ]);

        // 4. Buat Jadwal Keberangkatan
        Schedule::create([
            'route_id' => $route1->id,
            'bus_id' => $bus1->id,
            'departure_time' => '2026-05-10 08:00:00',
            'arrival_time' => '2026-05-10 09:00:00',
            'status' => 'scheduled',
        ]);

        Schedule::create([
            'route_id' => $route2->id,
            'bus_id' => $bus2->id,
            'departure_time' => '2026-05-10 10:00:00',
            'arrival_time' => '2026-05-10 13:00:00',
            'status' => 'scheduled',
        ]);
    }
}