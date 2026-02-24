@extends('admin.layout')

@section('page-title', 'Edit Pemesanan')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Pemesanan #{{ $pemesanan->id }}</h5>
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

        <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Jalur Pendakian</label>
                <select name="jalur_pendakian" class="form-select" required>
                    <option value="Selo" {{ $pemesanan->jalur_pendakian == 'Selo' ? 'selected' : '' }}>Selo</option>
                    <option value="Thekelan" {{ $pemesanan->jalur_pendakian == 'Thekelan' ? 'selected' : '' }}>Thekelan</option>
                    <option value="Wekas" {{ $pemesanan->jalur_pendakian == 'Wekas' ? 'selected' : '' }}>Wekas</option>
                    <option value="Suwanting" {{ $pemesanan->jalur_pendakian == 'Suwanting' ? 'selected' : '' }}>Suwanting</option>
                    <option value="Cunthel" {{ $pemesanan->jalur_pendakian == 'Cunthel' ? 'selected' : '' }}>Cunthel</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Naik</label>
                    <input type="date" name="tgl_naik" class="form-control" 
                           value="{{ old('tgl_naik', $pemesanan->tgl_naik) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Turun</label>
                    <input type="date" name="tgl_turun" class="form-control" 
                           value="{{ old('tgl_turun', $pemesanan->tgl_turun) }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Jumlah Anggota</label>
                <input type="number" name="jumlah_anggota" class="form-control" min="1"
                       value="{{ old('jumlah_anggota', $pemesanan->jumlah_anggota) }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">
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
