@extends('layout')

@section('content')

{{-- HEADER --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Hubungi Kami</h2>
        <p class="opacity-75">
            Informasi & bantuan seputar pendakian Gunung Merbabu
        </p>
    </div>
</div>

{{-- ISI KONTAK --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">

            <h5 class="fw-bold mb-3">
                Balai Taman Nasional Gunung Merbabu
            </h5>

            <p class="text-muted mb-5">
                Jika Anda membutuhkan informasi lebih lanjut terkait pendakian,
                silakan hubungi kami melalui kontak berikut.
            </p>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-geo-alt fs-2 text-primary"></i>
                        <h6 class="fw-bold mt-2">Alamat</h6>
                        <p class="small text-muted mb-0">
                            Boyolali, Jawa Tengah
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-telephone fs-2 text-success"></i>
                        <h6 class="fw-bold mt-2">Telepon Basecamp</h6>
                        <p class="small text-muted mb-0">
                            0857-3125-0559
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-envelope fs-2 text-warning"></i>
                        <h6 class="fw-bold mt-2">Email</h6>
                        <p class="small text-muted mb-0">
                            info@merbabu.id
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
