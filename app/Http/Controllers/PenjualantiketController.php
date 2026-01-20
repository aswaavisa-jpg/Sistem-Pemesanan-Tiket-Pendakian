<?php

namespace App\Http\Controllers;

use App\Models\Penjualantiket;
use Illuminate\Http\Request;

class PenjualantiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualantiket::all();
        return view('penjualantiket.index', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualantiket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik'            => 'required|unique:penjualantikets,nik',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'required',
            'no_hp'          => 'required|numeric',
            'jumlah_anggota' => 'required|numeric|min:1',
        ]);

        Penjualantiket::create($request->all());

        return redirect()->route('penjualantiket.index')
                         ->with('success', 'Data penjualan tiket berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualantiket $penjualantiket)
    {
        return view('penjualantiket.show', compact('penjualantiket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualantiket $penjualantiket)
    {
        return view('penjualantiket.edit', compact('penjualantiket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualantiket $penjualantiket)
    {
        $request->validate([
            'nik'            => 'required|unique:penjualantikets,nik,' . $penjualantiket->id,
            'nama'           => 'required',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'required',
            'no_hp'          => 'required|numeric',
            'jumlah_anggota' => 'required|numeric|min:1',
        ]);

        $penjualantiket->update($request->all());

        return redirect()->route('penjualantiket.index')
                         ->with('success', 'Data penjualan tiket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualantiket $penjualantiket)
    {
        $penjualantiket->delete();

        return redirect()->route('penjualantiket.index')
                         ->with('success', 'Data penjualan tiket berhasil dihapus!');
    }
}
