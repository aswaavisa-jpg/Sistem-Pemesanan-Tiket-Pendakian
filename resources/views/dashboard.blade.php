@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Sistem Informasi Pendakian</h2>
        <p class="mb-0 opacity-75">
            Gunung Merbabu
        </p>
    </div>
</div>

{{-- ================= MENU ================= --}}
<div class="container my-5">
    <div class="row g-4 text-center">

        {{-- Persyaratan --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow"
                 style="background: linear-gradient(#87CEEB); color:#fff;">
                <div class="card-body">
                    <i class="bi bi-clipboard-check fs-2 mb-3"></i>
                    <h6 class="fw-bold">Persyaratan Pendaki</h6>
                    <p class="small opacity-75">
                        Ketentuan administratif dan kesehatan
                    </p>
                    <a href="{{ route('persyaratan') }}"
                       class="btn btn-outline-light btn-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        {{-- Perlengkapan --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow"
                 style="background: linear-gradient(#87CEEB); color:#fff;">
                <div class="card-body">
                    <i class="bi bi-backpack fs-2 mb-3"></i>
                    <h6 class="fw-bold">Perlengkapan</h6>
                    <p class="small opacity-75">
                        Perlengkapan wajib pendakian
                    </p>
                    <a href="{{ route('perlengkapan') }}"
                       class="btn btn-outline-light btn-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

        {{-- Jalur --}}
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow"
                 style="background: linear-gradient(#87CEEB); color:#fff;">
                <div class="card-body">
                    <i class="bi bi-map fs-2 mb-3"></i>
                    <h6 class="fw-bold">Jalur Pendakian</h6>
                    <p class="small opacity-75">
                        Jalur resmi pendakian Merbabu
                    </p>
                    <a href="{{ route('jalur') }}"
                       class="btn btn-outline-light btn-sm">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
