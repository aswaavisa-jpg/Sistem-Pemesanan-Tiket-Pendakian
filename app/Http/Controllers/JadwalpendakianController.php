<?php

namespace App\Http\Controllers;

use App\Models\Jadwalpendakian;
use App\Models\Gunung;
use Illuminate\Http\Request;

class JadwalpendakianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwalpendakian::with('gunung')->get();
        return view('jadwalpendakian.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gunung = Gunung::all();
        return view('jadwalpendakian.create', compact('gunung'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gunung_id'     => 'required|exists:gunungs,id',
            'tanggal_naik'  => 'required|date',
            'tanggal_turun' => 'required|date|after_or_equal:tanggal_naik',
        ]);

        Jadwalpendakian::create($request->all());

        return redirect()->route('jadwalpendakian.index')
                         ->with('success', 'Jadwal pendakian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwalpendakian $jadwalpendakian)
    {
        $jadwalpendakian->load('gunung');
        return view('jadwalpendakian.show', compact('jadwalpendakian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwalpendakian $jadwalpendakian)
    {
        $gunung = Gunung::all();
        return view('jadwalpendakian.edit', compact('jadwalpendakian', 'gunung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwalpendakian $jadwalpendakian)
    {
        $request->validate([
            'gunung_id'     => 'required|exists:gunungs,id',
            'tanggal_naik'  => 'required|date',
            'tanggal_turun' => 'required|date|after_or_equal:tanggal_naik',
        ]);

        $jadwalpendakian->update($request->all());

        return redirect()->route('jadwalpendakian.index')
                         ->with('success', 'Jadwal pendakian berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwalpendakian $jadwalpendakian)
    {
        $jadwalpendakian->delete();

        return redirect()->route('jadwalpendakian.index')
                         ->with('success', 'Jadwal pendakian berhasil dihapus!');
    }
}
