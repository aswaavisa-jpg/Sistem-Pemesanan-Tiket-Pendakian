<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualantiket;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Penjualantiket::with('pemesanan')->paginate(15);
        return view('admin.transaksi.index', ['transaksi' => $transaksi]);
    }

    public function show(Penjualantiket $transaksi)
    {
        return view('admin.transaksi.show', ['transaksi' => $transaksi]);
    }

    public function edit(Penjualantiket $transaksi)
    {
        return view('admin.transaksi.edit', ['transaksi' => $transaksi->load('pemesanan')]);
    }

    public function update(Request $request, Penjualantiket $transaksi)
    {
        $validated = $request->validate([
            'kode_tiket' => 'required|string|max:50',
            'nama_pendaki' => 'required|string|max:255',
            'tanggal_pendakian' => 'required|date',
            'jumlah_tiket' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
        ]);

        $transaksi->update($validated);

        return redirect()->route('admin.transaksi.index')
                         ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Penjualantiket $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}

