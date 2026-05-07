<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('routes.index', compact('routes'));
    }

    public function create()
    {
        return view('routes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'departure' => 'required',
            'destination' => 'required',
            'base_price' => 'required|numeric',
        ]);

        Route::create($request->all());

        return redirect()->route('routes.index')->with('success', 'Rute baru berhasil ditambahkan!');
    }
}