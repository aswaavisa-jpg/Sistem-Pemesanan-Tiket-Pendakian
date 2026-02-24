@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Edit Pemesanan Tiket Pendakian</h2>
        <p class="mb-0 opacity-75">
            Perbarui data pemesanan pendakian Gunung Merbabu
        </p>
    </div>
</div>

{{-- ================= FORM EDIT PEMESANAN ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <form action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- NAMA PENDAKI --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pendaki</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ $pemesanan->nama }}"
                                   required>
                        </div>

                        {{-- JALUR PENDAKIAN --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jalur Pendakian</label>
                            <select name="jalur_pendakian" class="form-control" required>
                                <option value="">-- Pilih Jalur --</option>

                                @foreach ($gunung as $g)
                                    <option value="{{ $g->jalur_pendakian }}"
                                        {{ $g->jalur_pendakian == $pemesanan->jalur_pendakian ? 'selected' : '' }}>
                                        {{ $g->jalur_pendakian }}
                                    </option>
                                @endforeach

                                <option value="Selo" {{ $pemesanan->jalur_pendakian == 'Selo' ? 'selected' : '' }}>Selo</option>
                                <option value="Wekas" {{ $pemesanan->jalur_pendakian == 'Wekas' ? 'selected' : '' }}>Wekas</option>
                                <option value="Thekelan" {{ $pemesanan->jalur_pendakian == 'Thekelan' ? 'selected' : '' }}>Thekelan</option>
                                <option value="Cunthel" {{ $pemesanan->jalur_pendakian == 'Cunthel' ? 'selected' : '' }}>Cunthel</option>
                                <option value="Suwanting" {{ $pemesanan->jalur_pendakian == 'Suwanting' ? 'selected' : '' }}>Suwanting</option>
                            </select>
                        </div>

                        {{-- TANGGAL NAIK & TURUN --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Naik</label>
                                <input type="date"
                                       name="tgl_naik"
                                       class="form-control"
                                       value="{{ $pemesanan->tgl_naik }}"
                                       required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Turun</label>
                                <input type="date"
                                       name="tgl_turun"
                                       class="form-control"
                                       value="{{ $pemesanan->tgl_turun }}"
                                       required>
                            </div>
                        </div>

                        {{-- JUMLAH ANGGOTA --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Jumlah Anggota</label>
                            <input type="number"
                                   name="jumlah_anggota"
                                   class="form-control"
                                   min="1"
                                   value="{{ $pemesanan->jumlah_anggota }}"
                                   required>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pemesanan.index') }}"
                               class="btn btn-outline-secondary px-4">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn btn-warning px-5">
                                <i class="bi bi-pencil-square"></i> Update Pemesanan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
        color: #fff;
        transition: 0.3s;
    }

    .btn-outline-secondary:hover {
        background-color: #d6d6d6;
        transition: 0.3s;
    }
</style>

@endsection
