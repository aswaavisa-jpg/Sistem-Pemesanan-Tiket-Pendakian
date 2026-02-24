<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    // =======================
    // INDEX
    // =======================
    public function index()
    {
        // Filter agar hanya menampilkan detail pendaki milik user yang sedang login
        $detailpendaki = \App\Models\Detailpendaki::whereHas('pemesanan', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['pendaki', 'pemesanan'])->latest()->get();

        $jalur = \App\Models\Gunung::all();
        return view('pemesanan.index', compact('detailpendaki', 'jalur'));
    }

    // =======================
    // CREATE
    // =======================
    public function create()
    {
        $userId = Auth::id();

        // 1. Cek booking 'aktif' (sudah ada tiket pending/verified)
        $activeBooking = Pemesanan::where('user_id', $userId)
            ->whereHas('penjualantiket', function($q) {
                $q->whereIn('status_pembayaran', ['pending', 'verified']);
            })
            // Hanya blokir jika masih ada pendaki yang statusnya 'aktif' (belum diturunkan oleh admin)
            ->whereHas('pendakis', function($q) {
                $q->where('status_pendakian', 'aktif');
            })
            ->first();

        if ($activeBooking) {
            $ticket = $activeBooking->penjualantiket;
            
            // Tentukan pesan berdasarkan status pembayaran
            $statusMsg = ($ticket->status_pembayaran === 'pending') 
                ? 'Silakan selesaikan pembayaran atau tunggu tiket diverifikasi oleh admin.'
                : 'Tiket Anda sudah aktif (Verified). Silakan gunakan tiket ini untuk pendakian Anda sebelum membuat booking baru.';

            return redirect()->route('penjualantiket.show', $ticket->id)
                ->with('info', "Anda masih memiliki transaksi aktif. $statusMsg");
        }

        // 2. Cek booking 'gantung' (belum ada tiket)
        $incompleteBooking = Pemesanan::where('user_id', $userId)
            ->doesntHave('penjualantiket')
            ->latest()
            ->first();

        if ($incompleteBooking) {
            // Opsional: Langsung arahkan ke pengisian data pendaki
            return redirect()->route('detailpendaki.create')
                ->with('success', 'Anda memiliki pemesanan yang belum selesai. Silakan lanjutkan pengisian data.');
        }

        return view('pemesanan.create');
    }

    // =======================
    // STORE
    // =======================
    public function store(Request $request)
    {
        $userId = Auth::id();

        // 1. Cek booking 'aktif' (sudah ada tiket pending/verified) -> BLOKIR
        $activeBooking = Pemesanan::where('user_id', $userId)
            ->whereHas('penjualantiket', function($q) {
                $q->whereIn('status_pembayaran', ['pending', 'verified']);
            })
            ->whereHas('pendakis', function($q) {
                $q->where('status_pendakian', 'aktif');
            })
            ->first();

        if ($activeBooking) {
            return redirect()->route('dashboard')
                ->with('error', 'Anda masih memiliki transaksi aktif.');
        }

        // 2. Cek booking 'gantung' -> HAPUS otomatis (replace dengan yang baru)
        Pemesanan::where('user_id', $userId)
            ->doesntHave('penjualantiket')
            ->delete();

        // validasi inputan form
        $validatedData = $request->validate([
            'jalur_pendakian' => 'required|string',
            'tgl_naik'        => 'required|date',
            'tgl_turun'       => 'required|date|after_or_equal:tgl_naik',
        ]);

        // Set user_id dan jumlah_anggota otomatis 1
        $validatedData['user_id'] = Auth::id();
        $validatedData['jumlah_anggota'] = 1;

        // simpan pemesanan baru
        Pemesanan::create($validatedData);

        return redirect()->route('detailpendaki.create')
                         ->with('success', 'Pemesanan berhasil disimpan');
    }


    // =======================
    // SHOW
    // =======================
    public function show(Pemesanan $pemesanan)
    {
        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        return view('pemesanan.show', compact('pemesanan'));
    }

    // =======================
    // EDIT
    // =======================
    public function edit(Pemesanan $pemesanan)
    {
        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        return view('pemesanan.edit', compact('pemesanan'));
    }

    // =======================
    // UPDATE
    // =======================
    public function update(Request $request, Pemesanan $pemesanan)
    {
        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        $validatedData = $request->validate([
            'jalur_pendakian' => 'required',
            'tgl_naik'        => 'required|date',
            'tgl_turun'       => 'required|date',
            'jumlah_anggota'  => 'required|integer|min:1',
        ]);

        $pemesanan->update($validatedData);

        return redirect()->route('pemesanan.index')
                         ->with('success', 'Pemesanan berhasil diupdate');
    }

    // =======================
    // DESTROY
    // =======================
    public function destroy(Pemesanan $pemesanan)
    {
        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke pemesanan ini.');
        }

        $pemesanan->delete();

        return redirect()->route('pemesanan.index')
                         ->with('success', 'Pemesanan berhasil dihapus');
    }
}
