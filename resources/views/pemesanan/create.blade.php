@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Pemesanan Tiket Pendakian</h2>
        <p class="mb-0 opacity-75">
            Lengkapi data untuk melakukan pemesanan pendakian Gunung Merbabu
        </p>
    </div>
</div>

{{-- ================= FORM PEMESANAN ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    <form action="{{ route('pemesanan.store') }}" method="POST">
                        @csrf

                        {{-- PENDaki --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Nama Pendaki</label>
    <input type="text"
           name="nama_pendaki"
           class="form-control"
           placeholder="Masukkan nama lengkap"
           required>
</div>


                        {{-- JALUR PENDAKIAN --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Jalur Pendakian</label>
    <select name="jalur_pendakian" class="form-control" required>
        <option value="">-- Pilih Jalur --</option>
        
        {{-- Jalur dari database --}}
        @foreach ($gunung as $g)
            <option value="{{ $g->jalur_pendakian }}">
                {{ $g->jalur_pendakian }}
            </option>
        @endforeach

        {{-- Jalur populer Gunung Merbabu --}}
        <option value="Selo">Selo</option>
        <option value="Wekas">Wekas</option>
        <option value="Thekelan">Thekelan</option>
        <option value="Cunthel">Cunthel</option>
        <option value="Suwanting">Suwanting</option>
    </select>
</div>


                        {{-- TANGGAL NAIK DAN TURUN --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Naik</label>
                                <input type="date" name="tgl_naik" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Turun</label>
                                <input type="date" name="tgl_turun" class="form-control" required>
                            </div>
                        </div>

                        {{-- JUMLAH ANGGOTA --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Jumlah Anggota</label>
                            <input type="number"
                                   name="jumlah_anggota"
                                   class="form-control"
                                   min="1"
                                   required>
                        </div>

                        {{-- BUTTON --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}"
                               class="btn btn-outline-secondary px-4">
                                Kembali
                            </a>

                            <button type="submit"
                                    class="btn btn-success px-5">
                                <i class="bi bi-check-circle"></i> Simpan Pemesanan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
