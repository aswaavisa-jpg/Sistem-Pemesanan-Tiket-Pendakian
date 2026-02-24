<?php

namespace App\Http\Controllers;

use App\Models\Penjualantiket;
use App\Models\Pemesanan;
use App\Http\Requests\PaymentVerificationRequest;
use Illuminate\Http\Request;

class PenjualantiketController extends Controller
{
    const HARGA_PER_ORANG = 20000;

    public function index()
    {
        // Filter transaksi agar hanya menampilkan milik user yang sedang login
        $penjualantiket = Penjualantiket::whereHas('pemesanan', function($query) {
            $query->where('user_id', auth()->id());
        })->with('pemesanan')->latest()->get();

        return view('penjualantiket.index', compact('penjualantiket'));
    }

    public function create()
    {
        // Cari booking milik user yang belum punya tiket (pending booking)
        // Karena aturan 1 akun = 1 booking, kita bisa ambil yang latest
        $pemesanan = Pemesanan::where('user_id', auth()->id())
            ->doesntHave('penjualantiket')
            ->latest()
            ->first();
            
        if ($pemesanan) {
            // Jika ada booking gantung, langsung proses checkout
            return redirect()->route('penjualantiket.checkout', $pemesanan->id);
        }

        // Jika tidak ada booking yang bisa diproses
        return redirect()->route('dashboard')
            ->with('error', 'Anda tidak memiliki pemesanan yang belum diproses. Silakan lakukan Booking terlebih dahulu.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
        ], [
            'pemesanan_id.required' => 'Pemesanan harus dipilih',
            'pemesanan_id.exists' => 'Pemesanan yang dipilih tidak valid',
        ]);

        // Cek apakah sudah ada tiket untuk pemesanan ini
        $existingTicket = Penjualantiket::where('pemesanan_id', $request->pemesanan_id)->first();
        if ($existingTicket) {
             return redirect()->route('penjualantiket.show', $existingTicket->id);
        }

        $pemesanan = Pemesanan::findOrFail($request->pemesanan_id);
        
        // Generate kode tiket: JLR-[NAMALINTASAN][RANDOM]
        $jalurClean = strtoupper(str_replace(' ', '', $pemesanan->jalur_pendakian));
        $kodetiket = 'JLR-' . $jalurClean . strtoupper(substr(md5(time() . $pemesanan->id), 0, 4));
        
        // Hitung total harga berdasarkan jumlah anggota
        $totalHarga = $pemesanan->jumlah_anggota * self::HARGA_PER_ORANG;

        Penjualantiket::create([
            'kode_tiket' => $kodetiket,
            'pemesanan_id' => $pemesanan->id,
            'nama_pendaki' => $pemesanan->jalur_pendakian,
            'tanggal_pendakian' => $pemesanan->tgl_naik,
            'jumlah_tiket' => $pemesanan->jumlah_anggota,
            'total_harga' => $totalHarga,
            'harga_per_orang' => self::HARGA_PER_ORANG,
            'status_pembayaran' => 'pending',
        ]);

        return redirect()->route('penjualantiket.index')
            ->with('success', 'Transaksi berhasil disimpan. Lanjutkan dengan verifikasi pembayaran.');
    }

    public function show($id)
    {
        $transaksi = Penjualantiket::with('pemesanan', 'verifiedBy')->findOrFail($id);

        // Pastikan transaksi milik user yang login (kecuali admin)
        if (!auth()->check() || (auth()->user()->role !== 'Admin' && $transaksi->pemesanan->user_id !== auth()->id())) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses transaksi ini.');
        }

        return view('penjualantiket.show', compact('transaksi'));
    }

    /**
     * Tampilkan form pembayaran
     */
    public function editPayment($id)
    {
        $transaksi = Penjualantiket::with('pemesanan')->findOrFail($id);

        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $transaksi->pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke transaksi ini.');
        }
        
        // Jangan boleh edit jika sudah diverifikasi
        if ($transaksi->isVerified()) {
            return redirect()->route('penjualantiket.show', $transaksi->id)
                ->with('error', 'Pembayaran ini sudah diverifikasi');
        }

        return view('penjualantiket.payment', compact('transaksi'));
    }

    /**
     * Simpan data pembayaran dan kirim untuk verifikasi admin
     */
    public function submitPayment(PaymentVerificationRequest $request, $id)
    {
        $transaksi = Penjualantiket::with('pemesanan')->findOrFail($id);

        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $transaksi->pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke transaksi ini.');
        }

        // Jangan boleh submit jika sudah diverifikasi
        if ($transaksi->isVerified()) {
            return redirect()->route('penjualantiket.show', $transaksi->id)
                ->with('error', 'Pembayaran ini sudah diverifikasi');
        }

        $data = [
            'status_pembayaran' => 'pending',
            'metode_pembayaran' => $request->metode_pembayaran,
        ];

        // Handle upload bukti pembayaran
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . $transaksi->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pembayaran', $filename, 'public');
            $data['bukti_pembayaran'] = $path;
        }

        $transaksi->update($data);

        return redirect()->route('penjualantiket.show', $transaksi->id)
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function print($id)
    {
        $transaksi = Penjualantiket::with('pemesanan')->findOrFail($id);

        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $transaksi->pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke transaksi ini.');
        }
        
        // Block printing if payment is not verified
        if (!$transaksi->isVerified()) {
            return redirect()->route('penjualantiket.show', $transaksi->id)
                ->with('error', 'Tiket tidak dapat dicetak karena pembayaran belum diverifikasi oleh admin.');
        }
        
        return view('penjualantiket.print', compact('transaksi'));
    }

    /**
     * Halaman hasil scan QR Code — public, tanpa login
     */
    public function scanTicket($kode_tiket)
    {
        \Log::info("--- SCAN ATTEMPT START ---");
        \Log::info("Kode Tiket: " . $kode_tiket);

        try {
            $transaksi = Penjualantiket::with([
                'pemesanan.pendakis.pendaki',
                'pemesanan.user',
                'verifiedBy'
            ])->where('kode_tiket', $kode_tiket)->first();

            if (!$transaksi) {
                \Log::warning("Scan Result: Ticket Not Found.");
                abort(404, "Tiket tidak ditemukan.");
            }

            \Log::info("Scan Result: Success. Ticket ID: " . $transaksi->id);
            return view('penjualantiket.scan', compact('transaksi'));

        } catch (\Exception $e) {
            \Log::error("Scan Error: " . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response("Internal Server Error: " . $e->getMessage(), 500);
        }
    }

    /**
     * Checkout process - Auto create ticket from booking
     */
    public function checkout($pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        
        // Cek apakah sudah ada tiket
        $existingTicket = Penjualantiket::where('pemesanan_id', $pemesanan_id)->first();
        if ($existingTicket) {
            return redirect()->route('penjualantiket.show', $existingTicket->id);
        }

        // Generate kode tiket: JLR-[NAMALINTASAN][RANDOM]
        $jalurClean = strtoupper(str_replace(' ', '', $pemesanan->jalur_pendakian));
        $kodetiket = 'JLR-' . $jalurClean . strtoupper(substr(md5(time() . $pemesanan->id), 0, 4));
        
        // Hitung total harga
        $totalHarga = $pemesanan->jumlah_anggota * self::HARGA_PER_ORANG;

        $ticket = Penjualantiket::create([
            'kode_tiket' => $kodetiket,
            'pemesanan_id' => $pemesanan->id,
            'nama_pendaki' => $pemesanan->jalur_pendakian, // Note: This field naming seems odd in DB but keeping consistency
            'tanggal_pendakian' => $pemesanan->tgl_naik,
            'jumlah_tiket' => $pemesanan->jumlah_anggota,
            'total_harga' => $totalHarga,
            'harga_per_orang' => self::HARGA_PER_ORANG,
            'status_pembayaran' => 'pending',
        ]);

        return redirect()->route('penjualantiket.show', $ticket->id)
            ->with('success', 'Tiket berhasil dibuat. Silakan lanjutkan pembayaran.');
    }
}
