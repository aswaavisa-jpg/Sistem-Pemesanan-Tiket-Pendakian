<?php

namespace App\Http\Controllers;

use App\Models\Pendaki;
use Illuminate\Http\Request;

class PendakiController extends Controller
{
    public function index()
    {
        // Filter agar hanya menampilkan pendaki yang pernah didaftarkan oleh user ini
        $userId = auth()->id();
        $pendaki = Pendaki::whereHas('details.pemesanan', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('pendaki.index', compact('pendaki'));
    }

    /**
     * Check if NIK exists in database (for AJAX lookup)
     */
    public function checkNik(Request $request)
    {
        $nik = $request->query('nik');
        
        if (!$nik || strlen($nik) !== 16) {
            return response()->json(['exists' => false]);
        }

        $pendaki = Pendaki::where('nik', $nik)->first();

        if ($pendaki) {
            return response()->json([
                'exists' => true,
                'pendaki' => [
                    'id' => $pendaki->id,
                    'nik' => $pendaki->nik,
                    'nama' => $pendaki->nama,
                    'jenis_kelamin' => $pendaki->jenis_kelamin,
                    'tanggal_lahir' => $pendaki->tanggal_lahir,
                    'no_hp' => $pendaki->no_hp,
                    'rt_rw' => $pendaki->rt_rw,
                    'dusun' => $pendaki->dusun,
                    'desa' => $pendaki->desa,
                    'kecamatan' => $pendaki->kecamatan,
                    'kabupaten' => $pendaki->kabupaten,
                    'provinsi' => $pendaki->provinsi,
                ]
            ]);
        }

        return response()->json(['exists' => false]);
    }

    public function create()
    {
        return view('pendaki.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'pendaki_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pendaki', $filename, 'public');
            $data['foto'] = 'pendaki/' . $filename;
        }

        Pendaki::create($data);

        return redirect()->route('pemesanan.create')
            ->with('success', 'Pendaki berhasil disimpan, lanjut pemesanan');
    }

    public function edit($id)
    {
        $pendaki = Pendaki::findOrFail($id);

        // Pengecekan kepemilikan (Pernahkah user ini mendaftarkan pendaki ini?)
        $isOwner = auth()->user()->role === 'Admin' || $pendaki->details()->whereHas('pemesanan', function($q) {
            $q->where('user_id', auth()->id());
        })->exists();

        if (!$isOwner) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke data pendaki ini.');
        }

        return view('pendaki.edit', compact('pendaki'));
    }

    public function update(Request $request, $id)
    {
        $pendaki = Pendaki::findOrFail($id);

        // Pengecekan kepemilikan
        $isOwner = auth()->user()->role === 'Admin' || $pendaki->details()->whereHas('pemesanan', function($q) {
            $q->where('user_id', auth()->id());
        })->exists();

        if (!$isOwner) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke data pendaki ini.');
        }

        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($pendaki->foto && \Storage::disk('public')->exists($pendaki->foto)) {
                \Storage::disk('public')->delete($pendaki->foto);
            }

            $file = $request->file('foto');
            $filename = 'pendaki_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pendaki', $filename, 'public');
            $data['foto'] = 'pendaki/' . $filename;
        }

        $pendaki->update($data);

        return redirect()->route('pendaki.index')
            ->with('success', 'Pendaki berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pendaki = Pendaki::findOrFail($id);

        // Pengecekan kepemilikan
        $isOwner = auth()->user()->role === 'Admin' || $pendaki->details()->whereHas('pemesanan', function($q) {
            $q->where('user_id', auth()->id());
        })->exists();

        if (!$isOwner) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke data pendaki ini.');
        }
        
        // Delete photo if exists
        if ($pendaki->foto && \Storage::disk('public')->exists($pendaki->foto)) {
            \Storage::disk('public')->delete($pendaki->foto);
        }

        $pendaki->delete();

        return redirect()->route('pendaki.index')
            ->with('success', 'Pendaki berhasil dihapus');
    }
}
