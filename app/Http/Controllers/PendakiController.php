<?php

namespace App\Http\Controllers;

use App\Models\Pendaki;
use Illuminate\Http\Request;

class PendakiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaki = Pendaki::all();
        return view('pendaki.index', compact('pendaki'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendaki.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'nik'           => 'required|unique:pendakis,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'required|numeric',
            'alamat'        => 'required',
        ]);

        Pendaki::create($request->all());

        return redirect()->route('pendaki.index')
                         ->with('success', 'Data pendaki berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaki $pendaki)
    {
        return view('pendaki.show', compact('pendaki'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaki $pendaki)
    {
        return view('pendaki.edit', compact('pendaki'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaki $pendaki)
    {
        $request->validate([
            'nama'          => 'required',
            'nik'           => 'required|unique:pendakis,nik,' . $pendaki->id,
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'required|numeric',
            'alamat'        => 'required',
        ]);

        $pendaki->update($request->all());

        return redirect()->route('pendaki.index')
                         ->with('success', 'Data pendaki berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaki $pendaki)
    {
        $pendaki->delete();

        return redirect()->route('pendaki.index')
                         ->with('success', 'Data pendaki berhasil dihapus!');
    }
}
