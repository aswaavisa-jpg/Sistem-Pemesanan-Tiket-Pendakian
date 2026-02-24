<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualantiket;
use Illuminate\Http\Request;

class AdminPaymentVerificationController extends Controller
{
    /**
     * Tampilkan daftar pembayaran yang perlu diverifikasi
     */
    public function index()
    {
        $pembayaran = Penjualantiket::with('pemesanan', 'verifiedBy')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    /**
     * Tampilkan detail pembayaran untuk verifikasi
     */
    public function show(Penjualantiket $pembayaran)
    {
        $pembayaran->load(['pemesanan.pendakis.pendaki', 'verifiedBy']);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Verifikasi / setujui pembayaran
     */
    public function verify(Request $request, Penjualantiket $pembayaran)
    {
        $request->validate([
            'catatan_verifikasi' => 'nullable|string|max:500',
        ], [
            'catatan_verifikasi.max' => 'Catatan maksimal 500 karakter',
        ]);

        // Update status pembayaran menjadi verified
        $pembayaran->update([
            'status_pembayaran' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'catatan_verifikasi' => $request->catatan_verifikasi,
        ]);

        return redirect()->route('admin.pembayaran.show', $pembayaran->id)
            ->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    /**
     * Tolak pembayaran
     */
    public function reject(Request $request, Penjualantiket $pembayaran)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|max:500',
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan harus diisi',
            'alasan_penolakan.max' => 'Alasan penolakan maksimal 500 karakter',
        ]);

        // Update status pembayaran menjadi rejected
        $pembayaran->update([
            'status_pembayaran' => 'rejected',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
            'catatan_verifikasi' => 'DITOLAK: ' . $request->alasan_penolakan,
        ]);

        return redirect()->route('admin.pembayaran.show', $pembayaran->id)
            ->with('success', 'Pembayaran berhasil ditolak. User dapat mengunggah ulang bukti pembayaran.');
    }

    /**
     * Filter pembayaran berdasarkan status
     */
    public function filterByStatus($status)
    {
        $validStatus = ['pending', 'verified', 'rejected'];
        
        if (!in_array($status, $validStatus)) {
            return redirect()->route('admin.pembayaran.index')
                ->with('error', 'Status tidak valid');
        }

        $pembayaran = Penjualantiket::with('pemesanan', 'verifiedBy')
            ->where('status_pembayaran', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.pembayaran.index', compact('pembayaran', 'status'));
    }
}
