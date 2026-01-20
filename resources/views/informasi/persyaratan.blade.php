@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Persyaratan Pendaki</h2>
        <p class="opacity-75">
            Setiap pendaki wajib mematuhi ketentuan resmi yang berlaku demi menjaga keselamatan, ketertiban, dan kelestarian lingkungan Gunung Merbabu. Kepatuhan terhadap aturan pendakian menjadi bagian penting untuk memastikan kegiatan pendakian berjalan aman dan bertanggung jawab.
        </p>
    </div>
</div>

{{-- ================= ISI ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 text-center">

                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">Pendaki dalam kondisi sehat jasmani dan rohani</li>
                        <li class="list-group-item">Membawa identitas diri yang masih berlaku</li>
                        <li class="list-group-item">Melakukan pendaftaran dan pemesanan tiket resmi</li>
                        <li class="list-group-item">Mematuhi kuota dan jadwal pendakian</li>
                        <li class="list-group-item">Mengikuti arahan petugas lapangan</li>
                        <li class="list-group-item">Tidak membawa barang terlarang</li>
                        <li class="list-group-item">Menjaga kebersihan dan kelestarian alam</li>
                        <li class="list-group-item">Wajib melapor saat naik dan turun gunung</li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
