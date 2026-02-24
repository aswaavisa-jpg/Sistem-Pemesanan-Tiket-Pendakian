@extends('layout')

@section('content')

{{-- ================= HEADER / HERO (Original Style) ================= --}}
<div class="position-relative text-center text-white banner-hero"
     style="
        background:url('{{ asset('images/dashboard.jpg') }}') center/cover no-repeat;
        height:600px;
        margin-top:-80px;
     ">

    {{-- overlay gelap --}}
    <div class="position-absolute w-100 h-100"
         style="background:rgba(0,0,0,0.45); top:0; left:0;"></div>

    {{-- fade bawah --}}
    <div class="position-absolute bottom-0 w-100"
         style="
            height:160px;
            background:linear-gradient(to bottom,
            rgba(0,0,0,0) 0%,
            rgba(255,255,255,0.6) 70%,
            #fff 100%);
         ">
    </div>

    <div class="container position-relative d-flex flex-column justify-content-center align-items-center h-100">
        <h1 class="fw-bold mb-3">Selamat Datang di Gunung Merbabu</h1>
        <p class="mb-4 opacity-75 text-center">
            Pilih jalur, persiapkan perlengkapan, dan booking tiket pendakian resmi
        </p>
        @auth
            <a href="{{ route('pemesanan.create') }}" class="btn btn-booking btn-lg fw-bold">
                Booking Sekarang
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-booking btn-lg fw-bold">
                Booking Sekarang
            </a>
        @endauth
    </div>
</div>



{{-- ================= INFO BOX (New Modern Style) ================= --}}
<div class="container info-section">
    <div class="section-header">
        <h3 class="section-title">Informasi Pendakian</h3>
        <p class="section-subtitle">Persiapkan diri Anda sebelum melakukan pendakian</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="bi bi-backpack3"></i>
                </div>
                <h5 class="info-title">Perlengkapan</h5>
                <p class="info-text">Cek daftar perlengkapan wajib yang harus dibawa saat pendakian.</p>
                <a href="{{ route('perlengkapan') }}" class="info-link">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>
                <h5 class="info-title">Persyaratan</h5>
                <p class="info-text">Ketahui syarat resmi dan aturan yang berlaku untuk pendaki.</p>
                <a href="{{ route('persyaratan') }}" class="info-link">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="info-card">
                <div class="info-icon">
                    <i class="bi bi-signpost-split"></i>
                </div>
                <h5 class="info-title">Jalur Resmi</h5>
                <p class="info-text">Pilih jalur pendakian sesuai dengan kemampuan fisik Anda.</p>
                <a href="{{ route('jalur') }}" class="info-link">
                    Lihat Detail <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ================= QUOTA INFO (Riil Data) ================= --}}
@php
    $maxKuota = $maxKuota ?? 25;
    $totalPendakiAktif = $totalPendakiAktif ?? 0;
    $persenTersedia = max(0, round((($maxKuota - $totalPendakiAktif) / $maxKuota) * 100));
    $persenIsi = 100 - $persenTersedia;
@endphp

<div class="container mb-5">
    <div class="card border-0 shadow-sm" style="border-radius: 20px; background: #fff; border: 1px solid #edf2f7 !important;">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-lg-4 border-end">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 50px; height: 50px; background: #e0f2fe; color: #0369a1; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Pendaki Aktif Saat Ini</div>
                            <div style="font-size: 20px; color: #1e293b; font-weight: 700;">{{ $totalPendakiAktif }} Pendaki</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 border-end">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 50px; height: 50px; background: #f0fdf4; color: #166534; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div>
                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Batas Kuota Harian</div>
                            <div style="font-size: 20px; color: #1e293b; font-weight: 700;">{{ $maxKuota }} Orang / Hari</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="px-lg-3">
                        <div class="d-flex justify-content-between align-items-center mb-2 mt-3 mt-lg-0">
                            <span style="font-size: 12px; font-weight: 600; color: #64748b;">Ketersediaan Slot</span>
                            <span style="font-size: 12px; font-weight: 700; color: #16a34a;">{{ $persenTersedia }}% Tersedia</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 10px; background: #f1f5f9;">
                            <div class="progress-bar" role="progressbar" style="width: {{ $persenIsi }}%; background: linear-gradient(90deg, #facc15, #f59e0b); border-radius: 10px;" aria-valuenow="{{ $persenIsi }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="text-end mt-1">
                            <small style="font-size: 10px; color: #94a3b8;">Sisa {{ max(0, $maxKuota - $totalPendakiAktif) }} slot lagi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= ALUR PENDAKIAN (New Modern Style) ================= --}}
<div class="alur-section">
    <div class="container">
        <div class="section-header light">
            <h3 class="section-title">Alur Pendakian</h3>
            <p class="section-subtitle">8 langkah mudah untuk memulai pendakian Anda</p>
        </div>
        
        <div class="alur-grid">
            @php
            $alurData = [
                ['icon' => 'person-plus', 'title' => 'Daftar Akun', 'desc' => 'Buat akun pendaki'],
                ['icon' => 'file-earmark-text', 'title' => 'Lengkapi Data', 'desc' => 'Isi data anggota'],
                ['icon' => 'ticket-perforated', 'title' => 'Pesan Tiket', 'desc' => 'Pilih tanggal & jalur'],
                ['icon' => 'credit-card', 'title' => 'Pembayaran', 'desc' => 'Bayar biaya tiket'],
                ['icon' => 'patch-check', 'title' => 'Verifikasi', 'desc' => 'Tunggu konfirmasi'],
                ['icon' => 'box-seam', 'title' => 'Persiapan', 'desc' => 'Siapkan peralatan'],
                ['icon' => 'geo-alt', 'title' => 'Registrasi', 'desc' => 'Lapor di basecamp'],
                ['icon' => 'flag', 'title' => 'Pendakian', 'desc' => 'Mulai mendaki!']
            ];
            @endphp
            
            @foreach ($alurData as $index => $alur)
            <div class="alur-card">
                <div class="alur-number">{{ $index + 1 }}</div>
                <div class="alur-icon">
                    <i class="bi bi-{{ $alur['icon'] }}"></i>
                </div>
                <h6 class="alur-title">{{ $alur['title'] }}</h6>
                <p class="alur-desc">{{ $alur['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ================= MAPS BASECAMP (New Modern Style) ================= --}}
<div class="container maps-section">
    <div class="section-header">
        <h3 class="section-title">Lokasi Basecamp</h3>
        <p class="section-subtitle">5 basecamp resmi Gunung Merbabu di Jawa Tengah</p>
    </div>
    
    <div class="maps-tabs">
        <div class="tabs-nav">
            <button class="tab-btn active" data-target="selo">
                <i class="bi bi-geo-alt"></i> Selo
            </button>
            <button class="tab-btn" data-target="wekas">
                <i class="bi bi-geo-alt"></i> Wekas
            </button>
            <button class="tab-btn" data-target="thekelan">
                <i class="bi bi-geo-alt"></i> Thekelan
            </button>
            <button class="tab-btn" data-target="cunthel">
                <i class="bi bi-geo-alt"></i> Cunthel
            </button>
            <button class="tab-btn" data-target="suwanting">
                <i class="bi bi-geo-alt"></i> Suwanting
            </button>
        </div>
        
        @php
        $basecamp = [
            ['id'=>'selo','nama'=>'Basecamp Selo','alamat'=>'Boyolali, Jawa Tengah','map'=>'Basecamp+Selo+Merbabu', 'tingkat' => 'Menengah'],
            ['id'=>'wekas','nama'=>'Basecamp Wekas','alamat'=>'Magelang, Jawa Tengah','map'=>'Basecamp+Wekas+Merbabu', 'tingkat' => 'Mudah'],
            ['id'=>'thekelan','nama'=>'Basecamp Thekelan','alamat'=>'Boyolali, Jawa Tengah','map'=>'Basecamp+Thekelan+Merbabu', 'tingkat' => 'Sulit'],
            ['id'=>'cunthel','nama'=>'Basecamp Cunthel','alamat'=>'Semarang, Jawa Tengah','map'=>'Basecamp+Cunthel+Merbabu', 'tingkat' => 'Menengah'],
            ['id'=>'suwanting','nama'=>'Basecamp Suwanting','alamat'=>'Magelang, Jawa Tengah','map'=>'Basecamp+Suwanting+Merbabu', 'tingkat' => 'Mudah'],
        ];
        @endphp
        
        <div class="tabs-content">
            @foreach($basecamp as $i => $bc)
            <div class="tab-pane {{ $i==0 ? 'active':'' }}" id="tab-{{ $bc['id'] }}">
                <div class="map-card">
                    <div class="map-info">
                        <h5 class="map-title">{{ $bc['nama'] }}</h5>
                        <p class="map-address">
                            <i class="bi bi-pin-map"></i> {{ $bc['alamat'] }}
                        </p>
                        <span class="map-badge {{ strtolower($bc['tingkat']) }}">
                            {{ $bc['tingkat'] }}
                        </span>
                    </div>
                    <div class="map-frame">
                        <iframe 
                            src="https://www.google.com/maps?q={{ $bc['map'] }}&output=embed"
                            loading="lazy"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
/* Original Hero Button */
.btn-booking {
    background: rgba(255,193,7,.95);
    color:#000;
    box-shadow:0 8px 25px rgba(255,193,7,.35);
}

/* Section Styles */
.section-header {
    text-align: center;
    margin-bottom: 40px;
}

.section-header.light .section-title,
.section-header.light .section-subtitle {
    color: #fff;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}

.section-subtitle {
    color: #64748b;
    font-size: 16px;
}

/* Info Section */
.info-section {
    padding: 80px 0;
}

.info-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px 30px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s;
    height: 100%;
}

.info-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.info-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 36px;
    color: #fff;
}

.info-title {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 15px;
}

.info-text {
    color: #64748b;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 20px;
}

.info-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #22c55e;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.info-link:hover {
    color: #16a34a;
    gap: 12px;
}

/* Alur Section */
.alur-section {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 80px 0;
}

.alur-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.alur-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 25px 20px;
    text-align: center;
    transition: all 0.3s;
    position: relative;
}

.alur-card:hover {
    background: rgba(255,255,255,0.1);
    transform: translateY(-5px);
}

.alur-number {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    width: 24px;
    height: 24px;
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: #0f172a;
    border-radius: 50%;
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alur-icon {
    font-size: 32px;
    color: #facc15;
    margin-bottom: 15px;
}

.alur-title {
    color: #fff;
    font-weight: 600;
    margin-bottom: 5px;
}

.alur-desc {
    color: #94a3b8;
    font-size: 12px;
    margin: 0;
}

/* Maps Section */
.maps-section {
    padding: 80px 0;
}

.maps-tabs {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.1);
    overflow: hidden;
}

.tabs-nav {
    display: flex;
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 15px;
    gap: 10px;
    overflow-x: auto;
}

.tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: transparent;
    color: rgba(255,255,255,0.7);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s;
    white-space: nowrap;
}

.tab-btn:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
}

.tab-btn.active {
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: #0f172a;
    border-color: transparent;
}

.tabs-content {
    padding: 0;
}

.tab-pane {
    display: none;
}

.tab-pane.active {
    display: block;
}

.map-card {
    display: flex;
    flex-direction: column;
}

.map-info {
    padding: 25px 30px;
    border-bottom: 1px solid #e2e8f0;
}

.map-title {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}

.map-address {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    font-size: 14px;
    margin-bottom: 12px;
}

.map-badge {
    display: inline-block;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.map-badge.mudah { background: #d1fae5; color: #059669; }
.map-badge.menengah { background: #fef3c7; color: #b45309; }
.map-badge.sulit { background: #fee2e2; color: #dc2626; }

.map-frame {
    height: 350px;
}

.map-frame iframe {
    width: 100%;
    height: 100%;
    border: none;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    padding: 80px 0;
}

.cta-content {
    text-align: center;
}

.cta-title {
    color: #fff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-text {
    color: rgba(255,255,255,0.9);
    font-size: 18px;
    margin-bottom: 30px;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 18px 40px;
    background: #fff;
    color: #16a34a;
    border-radius: 50px;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    color: #16a34a;
}

/* Responsive */
@media (max-width: 992px) {
    .alur-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .alur-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .tabs-nav {
        justify-content: flex-start;
    }
    
    .cta-title {
        font-size: 1.8rem;
    }
}
</style>

<script>
// Tab functionality
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const target = this.dataset.target;
        
        // Remove active from all buttons and panes
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        
        // Add active to clicked button and corresponding pane
        this.classList.add('active');
        document.getElementById('tab-' + target).classList.add('active');
    });
});
</script>

@endsection
