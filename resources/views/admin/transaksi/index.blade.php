@extends('admin.layout')

@section('page-title', 'Daftar Transaksi Tiket')

@section('content')

<h5 style="margin-bottom: 20px; color: #333; font-weight: 700;">
    <i class="bi bi-credit-card"></i> Daftar Transaksi Tiket
</h5>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-container">
    @if($transaksi->isNotEmpty())
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
                    @foreach($transaksi as $item)
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
                                <a href="{{ route('admin.transaksi.edit', $item->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.transaksi.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 20px;">
            {{ $transaksi->links() }}
        </div>
    @else
        <p class="text-muted text-center" style="padding: 40px 0;">
            <i class="bi bi-inbox" style="font-size: 32px;"></i><br>
            Belum ada transaksi
        </p>
    @endif
</div>

@endsection
