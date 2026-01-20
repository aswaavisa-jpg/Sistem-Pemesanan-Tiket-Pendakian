@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Jalur Pendakian Gunung Merbabu</h2>
        <p class="mb-0 opacity-75">
            Gunung Merbabu memiliki beberapa jalur pendakian resmi yang dapat dipilih oleh pendaki. 
            Setiap jalur memiliki karakteristik medan, tingkat kesulitan, serta keindahan alam yang berbeda.
        </p>
    </div>
</div>

{{-- ================= ISI JALUR PENDAKIAN ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="row g-4 text-center">

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-signpost-split fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Jalur Selo</h6>
                        <p class="small text-muted mb-0">
                            Jalur favorit pendaki dengan medan terbuka dan pemandangan savana
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-tree fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Jalur Suwanting</h6>
                        <p class="small text-muted mb-0">
                            Jalur menantang dengan tanjakan panjang dan hutan lebat
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-map fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Jalur Wekas</h6>
                        <p class="small text-muted mb-0">
                            Jalur resmi yang cukup ramah bagi pendaki pemula
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-mountain fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Jalur Cuntel</h6>
                        <p class="small text-muted mb-0">
                            Jalur singkat namun memiliki medan yang cukup curam
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-compass fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Jalur Thekelan</h6>
                        <p class="small text-muted mb-0">
                            Jalur klasik dengan suasana hutan pinus dan jalur panjang
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ================= PENUTUP ================= --}}
<div class="py-5 text-center" style="background:#f8f9fa;">
    <div class="container">
        <p class="text-muted mb-0">
            Pilih jalur pendakian sesuai kemampuan demi keselamatan bersama
        </p>
    </div>
</div>

@endsection
