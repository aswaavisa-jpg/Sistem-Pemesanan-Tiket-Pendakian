@extends('admin.layout')

@section('page-title', 'Verifikasi Pembayaran')

@section('content')

<div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <h5 style="color: #333; font-weight: 700; margin: 0;">
        <i class="bi bi-credit-card-2-front"></i> Verifikasi Pembayaran
    </h5>

    <!-- Filter Status -->
    <div class="btn-group" role="group">
        <a href="{{ route('admin.pembayaran.index') }}" 
           class="btn btn-sm btn-outline-primary {{ request('status') == '' ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('admin.pembayaran.filterByStatus', 'pending') }}" 
           class="btn btn-sm btn-outline-warning {{ request('status') == 'pending' ? 'active' : '' }}">
            Pending
        </a>
        <a href="{{ route('admin.pembayaran.filterByStatus', 'verified') }}" 
           class="btn btn-sm btn-outline-success {{ request('status') == 'verified' ? 'active' : '' }}">
            Terverifikasi
        </a>
        <a href="{{ route('admin.pembayaran.filterByStatus', 'rejected') }}" 
           class="btn btn-sm btn-outline-danger {{ request('status') == 'rejected' ? 'active' : '' }}">
            Ditolak
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-container">
    @if($pembayaran->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode Tiket</th>
                        <th>Nama Pendaki</th>
                        <th>Total Harga</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->kode_tiket }}</strong>
                            </td>
                            <td>{{ $item->nama_pendaki }}</td>
                            <td>
                                <strong>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if($item->metode_pembayaran)
                                    @switch($item->metode_pembayaran)
                                        @case('transfer')
                                            <span class="badge bg-info"><i class="bi bi-bank2"></i> Transfer</span>
                                            @break
                                        @case('e-wallet')
                                            <span class="badge bg-success"><i class="bi bi-wallet2"></i> E-Wallet</span>
                                            @break
                                        @case('cash')
                                            <span class="badge bg-secondary"><i class="bi bi-cash-coin"></i> Cash</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $item->metode_pembayaran }}</span>
                                    @endswitch
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->isPending())
                                    <span class="badge bg-warning"><i class="bi bi-clock"></i> Pending</span>
                                @elseif($item->isVerified())
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Verified</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Rejected</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $item->created_at->format('d M Y H:i') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="btn-view">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 20px;">
            {{ $pembayaran->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 40px; color: #999;">
            <i class="bi bi-inbox" style="font-size: 3rem; margin-bottom: 10px; display: block;"></i>
            <p>Tidak ada data pembayaran</p>
        </div>
    @endif
</div>

<style>
    .btn-group {
        display: flex;
        gap: 5px;
    }

    .btn-group .btn {
        padding: 6px 12px;
        font-size: 14px;
    }

    .table-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .btn-view {
        padding: 6px 12px;
        background: #0d6efd;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s;
    }

    .btn-view:hover {
        background: #0b5ed7;
    }

    .table {
        margin: 0;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
    }
</style>

@endsection
