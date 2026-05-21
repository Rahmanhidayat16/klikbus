<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::all();
        
        // Tarik semua settingan dari database dan ubah jadi format Array (Key => Value)
        $settings = Setting::pluck('value', 'key')->toArray();
        
        return view('admin.settings.index', compact('payment_methods', 'settings'));
    }

    public function update(Request $request)
    {
        // 1. SIMPAN METODE PEMBAYARAN (Kodingan Lama)
        $methodsInput = $request->input('payment_methods', []);
        $allMethods = PaymentMethod::all();

        foreach ($allMethods as $method) {
            $status = isset($methodsInput[$method->id]) ? $methodsInput[$method->id] : 0;
            $method->update(['is_active' => $status]);
        }

        // 2. SIMPAN PENGATURAN TEKS / ANGKA (Ini Mesin Barunya!)
        // Ambil semua input form KECUALI token keamanan dan array metode pembayaran
        $inputs = $request->except(['_token', 'payment_methods']); 

        foreach ($inputs as $key => $value) {
            // UpdateOrCreate: Kalau kuncinya (misal 'app_name') udah ada, dia update isinya. 
            // Kalau belum ada, dia bikin baris baru di database. Pintar kan?
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Semua pengaturan berhasil disimpan!');
    }
}