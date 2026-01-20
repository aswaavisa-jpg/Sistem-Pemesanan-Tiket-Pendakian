<?php

namespace App\Http\Controllers;

use App\Models\Gunung;
use Illuminate\Http\Request;

class GunungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gunung = Gunung::all();
        return view('gunung.index', compact('gunung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gunung.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gunung'     => 'required',
            'status'          => 'required',
            'jalur_pendakian' => 'required',
        ]);

        Gunung::create($request->all());

        return redirect()->route('gunung.index')
                         ->with('success', 'Data gunung berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gunung $gunung)
    {
        return view('gunung.show', compact('gunung'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gunung $gunung)
    {
        return view('gunung.edit', compact('gunung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gunung $gunung)
    {
        $request->validate([
            'nama_gunung'     => 'required',
            'status'          => 'required',
            'jalur_pendakian' => 'required',
        ]);

        $gunung->update($request->all());

        return redirect()->route('gunung.index')
                         ->with('success', 'Data gunung berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gunung $gunung)
    {
        $gunung->delete();

        return redirect()->route('gunung.index')
                         ->with('success', 'Data gunung berhasil dihapus!');
    }

    /**
     * ===============================
     * HALAMAN JALUR RESMI (DASHBOARD)
     * ===============================
     */
    public function jalur()
    {
        $gunung = Gunung::all();
        return view('gunung.jalur', compact('gunung'));
    }
}
