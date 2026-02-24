@extends('layout')

@section('content')

{{-- ================= INFORMASI / SEJARAH ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-5">

                    <h4 class="fw-bold text-center mb-4">
                        Informasi Gunung Merbabu
                    </h4>

                    <p>
                        Gunung Merbabu memiliki ketinggian sekitar <strong>3.145 mdpl</strong> dan
                        berada di wilayah Kabupaten Magelang, Boyolali, dan Semarang.
                        Gunung ini dikelola secara resmi sebagai kawasan
                        <strong>Taman Nasional Gunung Merbabu</strong>.
                    </p>

                    <p>
                        Merbabu dikenal dengan jalur pendakian yang relatif aman,
                        pemandangan savana yang luas, serta panorama alam yang
                        menjadi daya tarik utama bagi pendaki lokal maupun luar daerah.
                    </p>

                    <p class="mb-0">
                        Untuk menjaga keselamatan pendaki dan kelestarian lingkungan,
                        sistem pemesanan tiket pendakian diterapkan secara resmi
                        guna mengatur kuota pendaki setiap harinya.
                    </p>

                </div>
            </div>

            {{-- ================= FAKTA CEPAT ================= --}}
            <div class="row g-4 text-center mb-5">

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-geo-alt fs-2 text-primary"></i>
                        <h6 class="fw-bold mt-3">Lokasi</h6>
                        <p class="text-muted small mb-0">
                            Jawa Tengah (Magelang, Boyolali, Semarang)
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-graph-up-arrow fs-2 text-success"></i>
                        <h6 class="fw-bold mt-3">Ketinggian</h6>
                        <p class="text-muted small mb-0">
                            ± 3.145 Meter di atas permukaan laut
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 border rounded shadow-sm h-100">
                        <i class="bi bi-shield-check fs-2 text-warning"></i>
                        <h6 class="fw-bold mt-3">Pengelolaan</h6>
                        <p class="text-muted small mb-0">
                            Taman Nasional Gunung Merbabu
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{{-- ================= DAFTAR JALUR ================= --}}
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h4 class="fw-bold text-center mb-4">Pilihan Jalur Pendakian</h4>
            <div class="row g-4 justify-content-center">
                
                {{-- 1. SELO --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden border-top border-primary border-4">
                        <div>
                            <img src="{{ asset('images/jalur/selo.jpg') }}" class="w-100" alt="Jalur Selo" onerror="this.src='https://placehold.co/600x400?text=Foto+Jalur+Selo'">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-2 text-primary">Jalur Selo (Boyolali)</h6>
                            <p class="small mb-1 text-dark"><strong>Karakter:</strong> Landai & Savana Luas</p>
                            <p class="small text-muted mb-0">
                                Jalur paling populer dengan akses mudah. Menawarkan pemandangan padang savana yang sangat luas di Pos 4 dan Pos 5. Cocok untuk pendaki pemula.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- 2. SUWANTING --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden border-top border-danger border-4">
                        <div>
                            <img src="{{ asset('images/jalur/suwanting.jpg') }}" class="w-100" alt="Jalur Suwanting" onerror="this.src='https://placehold.co/600x400?text=Foto+Jalur+Suwanting'">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-2 text-danger">Jalur Suwanting (Magelang)</h6>
                            <p class="small mb-1 text-dark"><strong>Karakter:</strong> Terjal & Hutan Pinus</p>
                            <p class="small text-muted mb-0">
                                Jalur menantang dengan kemiringan ekstrem tanpa banyak bonus landai. Menyuguhkan panorama hutan pinus dan pemandangan langsung ke Gunung Merapi.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- 3. WEKAS --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden border-top border-success border-4">
                        <div>
                            <img src="{{ asset('images/jalur/wekas.jpg') }}" class="w-100" alt="Jalur Wekas" onerror="this.src='https://placehold.co/600x400?text=Foto+Jalur+Wekas'">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-2 text-success">Jalur Wekas (Magelang)</h6>
                            <p class="small mb-1 text-dark"><strong>Karakter:</strong> Jalur Air & Pendek</p>
                            <p class="small text-muted mb-0">
                                Rute tersingkat menuju puncak. Kelebihannya adalah ketersediaan sumber air yang melimpah di sepanjang jalur dan pemandangan lembah yang hijau.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- 4. THEKELAN --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden border-top border-warning border-4">
                        <div>
                            <img src="{{ asset('images/jalur/thekelan.jpg') }}" class="w-100" alt="Jalur Thekelan" onerror="this.src='https://placehold.co/600x400?text=Foto+Jalur+Thekelan'">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-2 text-warning">Jalur Thekelan (Semarang)</h6>
                            <p class="small mb-1 text-dark"><strong>Karakter:</strong> Berbatu & Kawah</p>
                            <p class="small text-muted mb-0">
                                Jalur klasik yang melewati pos pemancar. Memiliki lanskap batuan vulkanik unik dan melewati area kawah belerang yang aktif namun aman.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- 5. CUNTEL --}}
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden border-top border-info border-4">
                        <div>
                            <img src="{{ asset('images/jalur/cuntel.jpg') }}" class="w-100" alt="Jalur Cuntel" onerror="this.src='https://placehold.co/600x400?text=Foto+Jalur+Cuntel'">
                        </div>
                        <div class="card-body">
                            <h6 class="fw-bold mb-2 text-info">Jalur Cuntel (Semarang)</h6>
                            <p class="small mb-1 text-dark"><strong>Karakter:</strong> Hutan Pinus & Pemandangan Kota</p>
                            <p class="small text-muted mb-0">
                                Berdekatan dengan jalur Thekelan, rute ini menawarkan pemandangan hutan pinus yang asri dan udara yang sangat sejuk. Jalur ini juga memberikan view indah ke arah Kota Salatiga dan Rawa Pening.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


{{-- ================= CATATAN KESELAMATAN ================= --}}
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="alert alert-info text-center shadow-sm">
                <i class="bi bi-info-circle me-2"></i>
                Pendaki diharapkan selalu mematuhi peraturan,
                membawa perlengkapan yang memadai,
                serta menjaga kebersihan lingkungan selama pendakian.
            </div>

        </div>
    </div>
</div>

@endsection
