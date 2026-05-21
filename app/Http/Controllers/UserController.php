<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Tarik semua data pengguna, urutkan dari yang terbaru
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }
}