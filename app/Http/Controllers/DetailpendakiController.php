<?php
namespace App\Http\Controllers;

use App\Models\Detailpendaki;
use App\Models\Pemesanan;
use App\Models\Pendaki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailpendakiController extends Controller
{
    public function index()
    {
        // Filter agar hanya menampilkan detail pendaki milik user yang sedang login
        $detailpendaki = Detailpendaki::whereHas('pemesanan', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['pemesanan','pendaki'])->get();

        return view('detail.index', compact('detailpendaki'));
    }

    public function create(Request $request)
    {
        // Ambil pemesanan milik user yang sedang login
        $pemesanan = Pemesanan::where('user_id', auth()->id())->latest()->first();
        
        if (!$pemesanan) {
            return redirect()->route('pemesanan.create')
                             ->with('error', 'Silakan buat pemesanan terlebih dahulu');
        }

        // Hitung berapa pendaki yang sudah terdaftar untuk pemesanan ini
        $existingCount = Detailpendaki::where('pemesanan_id', $pemesanan->id)->count();
        $jumlahAnggota = $pemesanan->jumlah_anggota;
        $sisaAnggota = $jumlahAnggota - $existingCount;

        // Jika sudah lengkap, redirect ke transaksi
        if ($sisaAnggota <= 0) {
            return redirect()->route('penjualantiket.create', ['pemesanan_id' => $pemesanan->id])
                             ->with('success', 'Semua anggota sudah terdaftar, silakan lanjut ke pembayaran');
        }

        return view('detail.create', compact('pemesanan', 'jumlahAnggota', 'sisaAnggota', 'existingCount'));
    }

    public function edit($id)
    {
        $detailpendaki = Detailpendaki::with('pemesanan')->findOrFail($id);
        
        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $detailpendaki->pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke data pendaki ini.');
        }

        $pendaki = $detailpendaki->pendaki;
        $pemesanan = Pemesanan::where('user_id', auth()->id())->get();
        return view('detail.edit', compact('detailpendaki', 'pendaki', 'pemesanan'));
    }

    public function store(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'pendaki' => 'required|array|min:1',
            'pendaki.*.nik' => 'required|string|size:16',
            'pendaki.*.nama' => 'required|string|max:100',
            'pendaki.*.jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pendaki.*.tanggal_lahir' => 'required|date',
            'pendaki.*.no_hp' => 'required|string|max:15',
            'pendaki.*.no_hp_darurat' => 'required|string|max:15',
            'pendaki.*.alamat' => 'nullable|string',
        ], [
            'pemesanan_id.required' => 'Pemesanan harus dipilih',
            'pendaki.*.nik.required' => 'NIK harus diisi',
            'pendaki.*.nik.size' => 'NIK harus 16 digit',
            'pendaki.*.nama.required' => 'Nama pendaki harus diisi',
            'pendaki.*.jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'pendaki.*.tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'pendaki.*.no_hp.required' => 'Nomor HP harus diisi',
            'pendaki.*.no_hp_darurat.required' => 'Nomor HP darurat harus diisi',
        ]);

        // Validasi file upload terpisah
        foreach ($request->pendaki as $index => $data) {
            $request->validate([
                "pendaki_foto_ktp_{$index}" => 'required|image|mimes:jpg,jpeg,png|max:2048',
                "pendaki_foto_selfie_{$index}" => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                "pendaki_foto_ktp_{$index}.required" => "Foto KTP pendaki " . ($index + 1) . " harus diupload",
                "pendaki_foto_ktp_{$index}.image" => "Foto KTP harus berupa gambar",
                "pendaki_foto_ktp_{$index}.max" => "Foto KTP maksimal 2MB",
                "pendaki_foto_selfie_{$index}.required" => "Foto selfie pendaki " . ($index + 1) . " harus diupload",
                "pendaki_foto_selfie_{$index}.image" => "Foto selfie harus berupa gambar",
                "pendaki_foto_selfie_{$index}.max" => "Foto selfie maksimal 2MB",
            ]);
        }

        // Cek NIK duplikat dalam satu submit
        $niks = array_column($request->pendaki, 'nik');
        if (count($niks) !== count(array_unique($niks))) {
            return back()->withErrors(['pendaki' => 'Terdapat NIK duplikat dalam pendaftaran'])
                         ->withInput();
        }

        $pemesananId = $request->pemesanan_id;

        DB::beginTransaction();
        try {
            foreach ($request->pendaki as $index => $pendakiData) {
                // Cari pendaki berdasarkan NIK
                $pendaki = Pendaki::where('nik', $pendakiData['nik'])->first();

                $addressData = [
                    'nama'           => $pendakiData['nama'],
                    'jenis_kelamin'  => $pendakiData['jenis_kelamin'],
                    'tanggal_lahir'  => $pendakiData['tanggal_lahir'],
                    'no_hp'          => $pendakiData['no_hp'],
                    'no_hp_darurat'  => $pendakiData['no_hp_darurat'],
                    'rt_rw'          => $pendakiData['rt_rw'] ?? null,
                    'dusun'          => $pendakiData['dusun'] ?? null,
                    'desa'           => $pendakiData['desa'] ?? null,
                    'kecamatan'      => $pendakiData['kecamatan'] ?? null,
                    'kabupaten'      => $pendakiData['kabupaten'] ?? null,
                    'provinsi'       => $pendakiData['provinsi'] ?? null,
                ];

                // Handle upload foto KTP
                if ($request->hasFile("pendaki_foto_ktp_{$index}")) {
                    $fotoKtp = $request->file("pendaki_foto_ktp_{$index}");
                    $namaKtp = 'ktp_' . $pendakiData['nik'] . '_' . time() . '.' . $fotoKtp->getClientOriginalExtension();
                    $addressData['foto_ktp'] = $fotoKtp->storeAs('pendaki/ktp', $namaKtp, 'public');
                }

                // Handle upload foto selfie
                if ($request->hasFile("pendaki_foto_selfie_{$index}")) {
                    $fotoSelfie = $request->file("pendaki_foto_selfie_{$index}");
                    $namaSelfie = 'selfie_' . $pendakiData['nik'] . '_' . time() . '.' . $fotoSelfie->getClientOriginalExtension();
                    $addressData['foto_selfie'] = $fotoSelfie->storeAs('pendaki/selfie', $namaSelfie, 'public');
                }

                if ($pendaki) {
                    // Update data pendaki jika sudah ada
                    $pendaki->update($addressData);
                } else {
                    // Buat pendaki baru jika NIK belum ada
                    $addressData['nik'] = $pendakiData['nik'];
                    $pendaki = Pendaki::create($addressData);
                }

                // Cek apakah sudah ada detail pendaki untuk kombinasi ini
                $existingDetail = Detailpendaki::where('pemesanan_id', $pemesananId)
                                               ->where('pendaki_id', $pendaki->id)
                                               ->first();

                if (!$existingDetail) {
                    // Buat detail pendaki (relasi pemesanan <-> pendaki)
                    Detailpendaki::create([
                        'pemesanan_id' => $pemesananId,
                        'pendaki_id'   => $pendaki->id,
                    ]);
                }
            }

            DB::commit();

            // Cek apakah sudah lengkap semua anggota
            $pemesanan = Pemesanan::find($pemesananId);
            $totalRegistered = Detailpendaki::where('pemesanan_id', $pemesananId)->count();

            if ($totalRegistered >= $pemesanan->jumlah_anggota) {
                return redirect()->route('penjualantiket.checkout', ['pemesanan_id' => $pemesananId])
                                 ->with('success', 'Semua anggota pendaki berhasil didaftarkan! Tiket Anda sedang diproses.');
            }

            return redirect()->route('detailpendaki.create')
                             ->with('success', 'Anggota pendaki berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                         ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $detailpendaki = Detailpendaki::with('pemesanan')->findOrFail($id);

        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $detailpendaki->pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke data pendaki ini.');
        }

        $pendaki = $detailpendaki->pendaki;

        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:pendakis,nik,' . $pendaki->id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'no_hp' => 'required|string|max:15',
            'dusun' => 'nullable|string',
            'desa' => 'nullable|string',
            'rt_rw' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
        ], [
            'pemesanan_id.required' => 'Pemesanan harus dipilih',
            'pemesanan_id.exists' => 'Pemesanan yang dipilih tidak valid',
            'nama.required' => 'Nama pendaki harus diisi',
            'nik.required' => 'NIK harus diisi',
            'nik.unique' => 'NIK sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
            'no_hp.required' => 'Nomor HP harus diisi',
        ]);

        // Update pendaki
        $pendaki->update($validated);

        // Update detail pendaki
        $detailpendaki->update([
            'pemesanan_id' => $validated['pemesanan_id'],
        ]);

        return redirect()->route('detailpendaki.index')
                         ->with('success','Data pendaki berhasil diperbarui');
    }

    public function destroy($id)
    {
        $detailpendaki = Detailpendaki::with('pemesanan')->findOrFail($id);

        // Pengecekan kepemilikan
        if (auth()->user()->role !== 'Admin' && $detailpendaki->pemesanan->user_id !== auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke data pendaki ini.');
        }

        $pendaki = $detailpendaki->pendaki;
        
        // Hapus detail pendaki terlebih dahulu
        $detailpendaki->delete();
        
        // Hapus data pendaki jika tidak terikat dengan detail lain
        if ($pendaki && $pendaki->details()->count() == 0) {
            $pendaki->delete();
        }

        return redirect()->route('detailpendaki.index')
                         ->with('success','Data pendaki berhasil dihapus');
    }
}
