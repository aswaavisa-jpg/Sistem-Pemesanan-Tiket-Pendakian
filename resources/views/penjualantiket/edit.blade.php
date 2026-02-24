@extends('layout')

@section('content')

{{-- HEADER --}}
<div class="text-center text-white"
     style="background:linear-gradient(135deg,#7c2d12,#9a3412); padding:150px 0 90px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Edit Penjualan Tiket</h2>
        <p class="opacity-75">
            Perbarui data penjualan tiket pendakian
        </p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0">
                <div class="card-body p-5">

                    <h5 class="fw-bold text-center mb-4">
                        Form Edit Tiket
                    </h5>

                    {{-- ERROR VALIDASI --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('penjualantiket.update', $penjualantiket->id) }}"
                          method="POST">
                        @csrf
                        @method('PUT')

                        {{-- KODE TIKET --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kode Tiket</label>
                            <input type="text"
                                   name="kode_tiket"
                                   class="form-control"
                                   value="{{ old('kode_tiket', $penjualantiket->kode_tiket) }}"
                                   required>
                        </div>

                        {{-- JALUR PENDAKIAN --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jalur Pendakian</label>
                            <input type="text"
                                   name="nama_pendaki"
                                   class="form-control"
                                   value="{{ old('nama_pendaki', $penjualantiket->nama_pendaki) }}"
                                   required>
                        </div>

                        {{-- TANGGAL PENDAKIAN --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Pendakian</label>
                            <input type="date"
                                   name="tanggal_pendakian"
                                   class="form-control"
                                   value="{{ old('tanggal_pendakian', $penjualantiket->tanggal_pendakian) }}"
                                   required>
                        </div>

                        {{-- JUMLAH TIKET --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jumlah Tiket</label>
                            <input type="number"
                                   name="jumlah_tiket"
                                   class="form-control"
                                   min="1"
                                   value="{{ old('jumlah_tiket', $penjualantiket->jumlah_tiket) }}"
                                   required>
                        </div>

                        {{-- TOTAL HARGA --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Total Harga (Rp)</label>
                            <input type="number"
                                   name="total_harga"
                                   class="form-control"
                                   value="{{ old('total_harga', $penjualantiket->total_harga) }}"
                                   required>
                        </div>

                        {{-- TOMBOL --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('penjualantiket.index') }}"
                               class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-warning">
                                Update Data
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
