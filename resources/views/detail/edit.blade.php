@extends('layout')

@section('content')

{{-- ================= HEADER SECTION ================= --}}
<div class="header-page">
    <div class="container text-center">
        <h2 class="fw-bold mb-2">Edit Anggota Pendaki</h2>
        <p class="mb-0 opacity-75">Ubah data anggota pendaki untuk pemesanan ini</p>
    </div>
</div>

{{-- ================= FORM SECTION ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 form-card">
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('detailpendaki.update', $detailpendaki->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Pilih Pemesanan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pemesanan</label>
                            <select name="pemesanan_id" class="form-control @error('pemesanan_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Pemesanan --</option>
                                @foreach ($pemesanan as $p)
                                    <option value="{{ $p->id }}" {{ (old('pemesanan_id') ?? $detailpendaki->pemesanan_id) == $p->id ? 'selected' : '' }}>
                                        {{ $p->jalur_pendakian }} | {{ \Carbon\Carbon::parse($p->tgl_naik)->format('d-m-Y') }} s/d {{ \Carbon\Carbon::parse($p->tgl_turun)->format('d-m-Y') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pemesanan_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pendaki</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                   placeholder="Nama Lengkap" value="{{ old('nama', $pendaki->nama) }}" required>
                            @error('nama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                   placeholder="Nomor NIK" value="{{ old('nik', $pendaki->nik) }}" required>
                            @error('nik')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ (old('jenis_kelamin') ?? $pendaki->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ (old('jenis_kelamin') ?? $pendaki->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       value="{{ old('tanggal_lahir', $pendaki->tanggal_lahir) }}" required>
                                @error('tanggal_lahir')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">No HP yang bisa dihubungi</label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                placeholder="Nomor HP aktif" value="{{ old('no_hp', $pendaki->no_hp) }}" required>
                            @error('no_hp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Section Alamat --}}
                        <div class="mb-4 pb-3 border-bottom">
                            <h5 class="fw-bold text-primary mb-3">
                                <i class="bi bi-geo-alt me-2"></i>Alamat
                            </h5>

                            {{-- Row 1: Dusun & Desa --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Dusun</label>
                                    <input type="text" name="dusun" class="form-control @error('dusun') is-invalid @enderror"
                                            placeholder="Nama Dusun" value="{{ old('dusun', $pendaki->dusun) }}">
                                    @error('dusun')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Desa</label>
                                    <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror"
                                            placeholder="Nama Desa" value="{{ old('desa', $pendaki->desa) }}">
                                    @error('desa')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Row 2: RT/RW & Kecamatan --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">RT/RW</label>
                                    <input type="text" name="rt_rw" class="form-control @error('rt_rw') is-invalid @enderror"
                                           placeholder="Contoh: 01/02" value="{{ old('rt_rw', $pendaki->rt_rw) }}">
                                    @error('rt_rw')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror"
                                            placeholder="Nama Kecamatan" value="{{ old('kecamatan', $pendaki->kecamatan) }}">
                                    @error('kecamatan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Row 3: Kabupaten & Provinsi --}}
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kabupaten/Kota</label>
                                    <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror"
                                            placeholder="Nama Kabupaten" value="{{ old('kabupaten', $pendaki->kabupaten) }}">
                                    @error('kabupaten')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Provinsi</label>
                                    <input type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror"
                                            placeholder="Nama Provinsi" value="{{ old('provinsi', $pendaki->provinsi) }}">
                                    @error('provinsi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success px-4">
                                <i class="bi bi-save me-1"></i> Perbarui
                            </button>

                            <a href="{{ route('detailpendaki.index') }}"
                               class="btn btn-secondary px-4">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
/* Header */
.header-page {
    background: linear-gradient(
        to bottom,
        #4fa3c7,
        #8fd3ea,
        #ffffff
    );
    padding: 80px 0 90px;
}

/* Card */
.form-card {
    border-radius: 14px;
    margin-top: -60px;
    background: #fff;
}

/* Input focus */
.form-control:focus {
    border-color: #4fa3c7;
    box-shadow: 0 0 0 0.15rem rgba(79,163,199,.25);
}

/* Button hover */
.btn-success:hover {
    background-color: #157347;
}

.btn-secondary:hover {
    background-color: #5c636a;
}
</style>

@endsection
