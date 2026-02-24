<?php

namespace App\Http\Controllers;

use App\Models\Gunung;

class GunungController extends Controller
{
    // HALAMAN POINT 4 (LIST DATA)
    public function index()
    {
        $data = Gunung::latest()->get();
        return view('gunung.index', compact('data'));
    }

    // HALAMAN DETAIL
    public function show($id)
    {
        $gunung = Gunung::with('jadwalPendakians')->findOrFail($id);
        return view('gunung.detail', compact('gunung'));
    }
}
