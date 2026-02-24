@extends('admin.layout')

@section('page-title', 'Detail Transaksi Tiket')

@section('content')

<div style="margin-bottom: 20px;">
    <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<h5 style="margin-bottom: 20px; color: #333; font-weight: 700;">
    <i class="bi bi-credit-card"></i> Detail Transaksi Tiket
</h5>

<div class="card" style="margin-bottom: 20px;">
    <div class="card-header bg-light">
        <h6 class="mb-0">Informasi Transaksi</h6>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Kode Tiket:</strong></p>
                <p style="color: #666;">{{ $transaksi->kode_tiket }}</p>
            </div>
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Nama Pendaki:</strong></p>
                <p style="color: #666;">{{ $transaksi->nama_pendaki }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Tanggal Pendakian:</strong></p>
                <p style="color: #666;">{{ \Carbon\Carbon::parse($transaksi->tanggal_pendakian)->format('d M Y') }}</p>
            </div>
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Jumlah Tiket:</strong></p>
                <p style="color: #666;">{{ $transaksi->jumlah_tiket }} tiket</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Harga Per Orang:</strong></p>
                <p style="color: #666;">Rp {{ number_format($transaksi->harga_per_orang, 0, ',', '.') }}</p>
            </div>
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Total Harga:</strong></p>
                <p style="color: #666;"><strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></p>
            </div>
        </div>

        @if($transaksi->pemesanan)
        <hr>
        <h6 style="margin-bottom: 15px; color: #333;">Informasi Pemesanan</h6>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Jalur Pendakian:</strong></p>
                <p style="color: #666;">{{ $transaksi->pemesanan->jalur_pendakian ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Jumlah Anggota:</strong></p>
                <p style="color: #666;">{{ $transaksi->pemesanan->jumlah_anggota ?? '-' }} orang</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Tanggal Mulai:</strong></p>
                <p style="color: #666;">{{ \Carbon\Carbon::parse($transaksi->pemesanan->tanggal_mulai)->format('d M Y H:i') ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <p style="margin-bottom: 5px;"><strong>Tanggal Selesai:</strong></p>
                <p style="color: #666;">{{ \Carbon\Carbon::parse($transaksi->pemesanan->tanggal_selesai)->format('d M Y H:i') ?? '-' }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <p style="margin-bottom: 5px;"><strong>Catatan:</strong></p>
                <p style="color: #666;">{{ $transaksi->pemesanan->catatan ?? '-' }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

<div style="margin-top: 20px;">
    <form action="{{ route('admin.transaksi.destroy', $transaksi->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus transaksi ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <i class="bi bi-trash"></i> Hapus Transaksi
        </button>
    </form>
</div>

@endsection
