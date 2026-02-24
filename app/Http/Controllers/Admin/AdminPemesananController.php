<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class AdminPemesananController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesanan::with('details')->paginate(15);
        return view('admin.pemesanan.index', ['pemesanan' => $pemesanan]);
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('admin.pemesanan.show', ['pemesanan' => $pemesanan->load('details')]);
    }

    public function edit(Pemesanan $pemesanan)
    {
        return view('admin.pemesanan.edit', ['pemesanan' => $pemesanan]);
    }

    public function update(Request $request, Pemesanan $pemesanan)
    {
        $validated = $request->validate([
            'jalur_pendakian' => 'required|string|max:255',
            'tgl_naik' => 'required|date',
            'tgl_turun' => 'required|date|after_or_equal:tgl_naik',
            'jumlah_anggota' => 'required|integer|min:1',
        ]);

        $pemesanan->update($validated);

        return redirect()->route('admin.pemesanan.index')
                         ->with('success', 'Pemesanan berhasil diperbarui');
    }

    public function destroy(Pemesanan $pemesanan)
    {
        $pemesanan->delete();
        return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil dihapus');
    }
}

