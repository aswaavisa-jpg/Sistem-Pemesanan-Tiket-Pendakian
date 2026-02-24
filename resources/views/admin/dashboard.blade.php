@extends('admin.layout')

@section('page-title', 'Dashboard Admin')

@section('content')

{{-- STATISTICS --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon users">
                <i class="bi bi-people-fill"></i>
            </div>
            <h6>Total Users</h6>
            <p class="number">{{ $totalUsers }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon orders">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <h6>Total Pemesanan</h6>
            <p class="number">{{ $totalPemesanan }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon transactions">
                <i class="bi bi-credit-card-fill"></i>
            </div>
            <h6>Total Transaksi</h6>
            <p class="number">{{ $totalTransaksi }}</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon climbers">
                <i class="bi bi-person-hiking"></i>
            </div>
            <h6>Total Pendaki</h6>
            <p class="number">{{ $totalPendaki }}</p>
        </div>
    </div>
</div>

{{-- RECENT ORDERS --}}
<div class="table-container">
    <h5>
        <i class="bi bi-calendar-check"></i> Pemesanan Terbaru
    </h5>
    @if($recentPemesanan->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jalur</th>
                        <th>Tanggal Naik</th>
                        <th>Jumlah Anggota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPemesanan as $item)
                        <tr>
                            <td><strong>#{{ $item->id }}</strong></td>
                            <td>{{ $item->jalur_pendakian }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_naik)->format('d M Y') }}</td>
                            <td><span class="badge bg-info">{{ $item->jumlah_anggota }} orang</span></td>
                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                            <td>
                                <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="btn-view">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">Belum ada pemesanan</p>
    @endif
</div>

{{-- RECENT TRANSACTIONS --}}
<div class="table-container">
    <h5>
        <i class="bi bi-credit-card"></i> Transaksi Terbaru
    </h5>
    @if($recentTransaksi->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode Tiket</th>
                        <th>Jalur</th>
                        <th>Jumlah Tiket</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransaksi as $item)
                        <tr>
                            <td><strong>{{ $item->kode_tiket }}</strong></td>
                            <td>{{ $item->pemesanan->jalur_pendakian ?? '-' }}</td>
                            <td><span class="badge bg-success">{{ $item->pemesanan->jumlah_anggota ?? 0 }}</span></td>
                            <td><strong>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong></td>
                            <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.transaksi.show', $item->id) }}" class="btn-view">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">Belum ada transaksi</p>
    @endif
</div>

@endsection
