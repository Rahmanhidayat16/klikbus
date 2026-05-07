<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        // Untuk simulasi tugas kuliah, kita kasih pesan sukses aja dulu
        // Karena buat kirim email beneran butuh setting Mailtrap/SMTP
        return back()->with('status', 'Link reset password sudah dikirim ke email (simulasi).');
    }
}