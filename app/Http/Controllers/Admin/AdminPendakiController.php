<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detailpendaki;
use App\Models\Pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPendakiController extends Controller
{
    public function index()
    {
        return view('admin.pendaki.index');
    }

    public function pendakiFilter(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput   = $request->input('end_date');
        $perPage        = (int) ($request->input('per_page') ?: 15);

        $startDate = !empty($startDateInput)
            ? Carbon::parse($startDateInput)->startOfDay()
            : Carbon::create(2020, 1, 1)->startOfDay();

        $endDate = !empty($endDateInput)
            ? Carbon::parse($endDateInput)->endOfDay()
            : now()->endOfYear();

        // QUERY PALING AMAN
        $pendaki = Detailpendaki::with(['pendaki', 'pemesanan'])
            ->whereHas('pemesanan', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('tgl_naik', [$startDate, $endDate]);
            })
            ->orderByDesc('created_at') // 🔥 ANTI ERROR
            ->paginate($perPage);

        $today = Carbon::today();

        $data = $pendaki->getCollection()->map(function ($item) use ($today) {
            $pemesanan = $item->pemesanan;
            
            // Logika Terlambat Turun: Status Aktif DAN Tanggal hari ini > Tanggal Turun
            $isOverdue = false;
            if (($item->status_pendakian ?? 'aktif') === 'aktif' && $pemesanan?->tgl_turun) {
                $tglTurun = Carbon::parse($pemesanan->tgl_turun)->startOfDay();
                if ($today->gt($tglTurun)) {
                    $isOverdue = true;
                }
            }

            return [
                'id' => $item->id,
                'nama' => $item->pendaki->nama ?? '-',
                'nik' => $item->pendaki->nik ?? '-',
                'no_hp' => $item->pendaki->no_hp ?? '-',
                'no_hp_darurat' => $item->pendaki->no_hp_darurat ?? '-',
                'foto_ktp' => $item->pendaki->foto_ktp,
                'foto_selfie' => $item->pendaki->foto_selfie,
                'jenis_kelamin' => $item->pendaki->jenis_kelamin ?? '-',
                'tanggal_lahir' => $item->pendaki->tanggal_lahir
                    ? Carbon::parse($item->pendaki->tanggal_lahir)->format('d/m/Y')
                    : '-',
                'tgl_naik' => $pemesanan?->tgl_naik
                    ? Carbon::parse($pemesanan->tgl_naik)->format('d/m/Y')
                    : '-',
                'tgl_turun' => $pemesanan?->tgl_turun
                    ? Carbon::parse($pemesanan->tgl_turun)->format('d/m/Y')
                    : '-',
                'jalur_pendakian' => $pemesanan->jalur_pendakian ?? '-',
                'status_pendakian' => $item->status_pendakian ?? 'aktif',
                'is_overdue' => $isOverdue,
                'alamat' => collect([
                    $item->pendaki->dusun,
                    $item->pendaki->desa,
                    $item->pendaki->rt_rw,
                    $item->pendaki->kecamatan,
                    $item->pendaki->kabupaten,
                    $item->pendaki->provinsi
                ])->filter()->implode(', ') ?: '-',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'pagination' => [
                'current_page' => $pendaki->currentPage(),
                'last_page' => $pendaki->lastPage(),
                'per_page' => $pendaki->perPage(),
                'total' => $pendaki->total(),
                'from' => $pendaki->firstItem(),
                'to' => $pendaki->lastItem(),
            ],
            'period' => [
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
            ],
        ]);
    }

    public function show($id)
    {
        $detailpendaki = Detailpendaki::with(['pendaki', 'pemesanan'])->findOrFail($id);
        return view('admin.pendaki.show', ['pendaki' => $detailpendaki]);
    }

    public function destroy($id)
    {
        Detailpendaki::findOrFail($id)->delete();
        return redirect()->route('admin.pendaki.index')
            ->with('success', 'Data pendaki berhasil dihapus');
    }

    public function confirmDescent($id)
    {
        $detailpendaki = Detailpendaki::findOrFail($id);
        $detailpendaki->update(['status_pendakian' => 'selesai']);
        
        return redirect()->back()
            ->with('success', 'Konfirmasi turun pendaki berhasil disimpan');
    }

    public function report()
    {
        return view('admin.pendaki.report');
    }

    public function reportFilter(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput   = $request->input('end_date');
        $perPage        = (int) ($request->input('per_page') ?: 15);

        $startDate = !empty($startDateInput)
            ? Carbon::parse($startDateInput)->startOfDay()
            : Carbon::create(2020, 1, 1)->startOfDay();

        $endDate = !empty($endDateInput)
            ? Carbon::parse($endDateInput)->endOfDay()
            : now()->endOfYear();

        $transaksi = Pemesanan::withCount('pendakis')
            ->with('penjualantiket')
            ->whereBetween('tgl_naik', [$startDate, $endDate])
            ->orderByDesc('created_at')
            ->paginate($perPage);

        $today = Carbon::today();

        $data = $transaksi->getCollection()->map(function ($item) use ($today) {
            $tglNaik = Carbon::parse($item->tgl_naik);
            $penjualantiket = $item->penjualantiket;
            return [
                'id' => $item->id,
                'kode_transaksi' => 'TRX-' . str_pad($item->id, 5, '0', STR_PAD_LEFT),
                'jumlah_pendaki' => $item->pendakis_count,
                'tgl_naik' => $tglNaik->format('d/m/Y'),
                'tgl_turun' => Carbon::parse($item->tgl_turun)->format('d/m/Y'),
                'jalur_pendakian' => $item->jalur_pendakian ?? '-',
                'created_at' => $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-',
                'is_past' => $tglNaik->lt($today),
                'penjualantiket_id' => $penjualantiket ? $penjualantiket->id : null,
                'status_pembayaran' => $penjualantiket ? $penjualantiket->status_pembayaran : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'pagination' => [
                'current_page' => $transaksi->currentPage(),
                'last_page' => $transaksi->lastPage(),
                'per_page' => $transaksi->perPage(),
                'total' => $transaksi->total(),
                'from' => $transaksi->firstItem(),
                'to' => $transaksi->lastItem(),
            ],
            'period' => [
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'start_date_formatted' => $startDate->format('d/m/Y'),
                'end_date_formatted' => $endDate->format('d/m/Y'),
            ],
        ]);
    }

    public function transactionDetail($id)
    {
        $pemesanan = Pemesanan::with(['pendakis.pendaki'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'kode_transaksi' => 'TRX-' . str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT),
            'jalur_pendakian' => $pemesanan->jalur_pendakian,
            'tgl_naik' => Carbon::parse($pemesanan->tgl_naik)->format('d/m/Y'),
            'tgl_turun' => Carbon::parse($pemesanan->tgl_turun)->format('d/m/Y'),
            'pendaki' => $pemesanan->pendakis->map(function ($detail) {
                return [
                    'nama' => $detail->pendaki->nama ?? '-',
                    'nik' => $detail->pendaki->nik ?? '-',
                    'no_hp' => $detail->pendaki->no_hp ?? '-',
                    'no_hp_darurat' => $detail->pendaki->no_hp_darurat ?? '-',
                    'foto_ktp' => $detail->pendaki->foto_ktp,
                    'foto_selfie' => $detail->pendaki->foto_selfie,
                    'jenis_kelamin' => $detail->pendaki->jenis_kelamin ?? '-',
                    'tanggal_lahir' => $detail->pendaki->tanggal_lahir
                        ? Carbon::parse($detail->pendaki->tanggal_lahir)->format('d/m/Y')
                        : '-',
                    'status_pendakian' => $detail->status_pendakian ?? 'aktif',
                ];
            }),
        ]);
    }
}
