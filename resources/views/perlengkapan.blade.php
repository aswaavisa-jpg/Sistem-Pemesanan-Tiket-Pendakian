@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Perlengkapan Wajib Pendakian</h2>
        <p class="mb-0 opacity-75">
            Setiap pendaki di wajibkan membawa perlengkapan yang memadai untuk menunjang keselamatan dan kenyamanan selama pendakian. Perlengkapan yang lengkap membantu pendaki menghadapi kondisi cuaca, medan pendakian, serta kebutuhan logistik agar pendakian berjalan aman dan lancar.
        </p>
    </div>
</div>

{{-- ================= ISI PERLENGKAPAN ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="row g-4 text-center">

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-backpack fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Tas Carrier</h6>
                        <p class="small text-muted mb-0">
                            Tas gunung untuk membawa seluruh perlengkapan pendakian
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
    <div class="p-4 border rounded shadow-sm h-100">
        <i class="bi bi-shield-check fs-2 text-success"></i>
        <h6 class="fw-bold mt-2">Sepatu Safety Gunung</h6>
        <p class="small text-muted mb-0">
            Melindungi kaki dan menjaga kestabilan saat pendakian
        </p>
    </div>
</div>


                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-cloud-rain fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Jas Hujan</h6>
                        <p class="small text-muted mb-0">
                            Mengantisipasi cuaca ekstrem dan hujan
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-lightning-charge fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Senter / Headlamp</h6>
                        <p class="small text-muted mb-0">
                            Penerangan saat malam hari atau kondisi gelap
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-cup-hot fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Logistik & Air</h6>
                        <p class="small text-muted mb-0">
                            Bekal makanan dan minuman selama pendakian
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-bandaid fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">P3K</h6>
                        <p class="small text-muted mb-0">
                            Peralatan pertolongan pertama saat keadaan darurat
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
            Perlengkapan lengkap membantu pendakian lebih aman dan nyaman
        </p>
    </div>
</div>

@endsection
