<?php

namespace App\Http\Controllers;

use App\Models\Detailpendaki;
use App\Models\Pemesanan;
use App\Models\Pendaki;
use Illuminate\Http\Request;

class DetailpendakiController extends Controller
{
    public function index()
    {
        $detailpendaki = Detailpendaki::with(['pemesanan', 'pendaki'])->get();
        return view('detailpendaki.index', compact('detailpendaki'));
    }

    public function create()
{
    $pemesanans = Pemesanan::all();
    $pendakis   = Pendaki::all();

    return view('detailpendaki.create', compact('pemesanans', 'pendakis'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'pendaki_id'   => 'required|exists:pendakis,id',
        ]);

        Detailpendaki::create($validated);

        return redirect()
            ->route('detailpendaki.index')
            ->with('success', 'Detail pendaki berhasil ditambahkan');
    }

    public function show(Detailpendaki $detailpendaki)
    {
        $detailpendaki->load(['pemesanan', 'pendaki']);
        return view('detailpendaki.show', compact('detailpendaki'));
    }

    public function edit(Detailpendaki $detailpendaki)
    {
        return view('detailpendaki.edit', [
            'detailpendaki' => $detailpendaki,
            'pemesanan'     => Pemesanan::all(),
            'pendaki'       => Pendaki::all(),
        ]);
    }

    public function update(Request $request, Detailpendaki $detailpendaki)
    {
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'pendaki_id'   => 'required|exists:pendakis,id',
        ]);

        $detailpendaki->update($validated);

        return redirect()
            ->route('detailpendaki.index')
            ->with('success', 'Detail pendaki berhasil diperbarui');
    }

    public function destroy(Detailpendaki $detailpendaki)
    {
        $detailpendaki->delete();

        return redirect()
            ->route('detailpendaki.index')
            ->with('success', 'Detail pendaki berhasil dihapus');
    }
}
