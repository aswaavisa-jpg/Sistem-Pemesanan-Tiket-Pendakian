@extends('admin.layout')

@section('page-title', 'Edit Transaksi')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Transaksi {{ $transaksi->kode_tiket }}</h5>
    </div>
    <div class="card-body p-4">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Tiket</label>
                <input type="text" name="kode_tiket" class="form-control" 
                       value="{{ old('kode_tiket', $transaksi->kode_tiket) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Jalur Pendakian</label>
                <input type="text" name="nama_pendaki" class="form-control" 
                       value="{{ old('nama_pendaki', $transaksi->nama_pendaki) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal Pendakian</label>
                <input type="date" name="tanggal_pendakian" class="form-control" 
                       value="{{ old('tanggal_pendakian', $transaksi->tanggal_pendakian) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jumlah Tiket</label>
                    <input type="number" name="jumlah_tiket" class="form-control" min="1"
                           value="{{ old('jumlah_tiket', $transaksi->jumlah_tiket) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Total Harga (Rp)</label>
                    <input type="number" name="total_harga" class="form-control" min="0"
                           value="{{ old('total_harga', $transaksi->total_harga) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Status Pembayaran</label>
                <input type="text" class="form-control" value="{{ ucfirst($transaksi->status_pembayaran) }}" disabled>
                <small class="text-muted">Status pembayaran dikelola di menu Verifikasi Pembayaran</small>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

@endsection
