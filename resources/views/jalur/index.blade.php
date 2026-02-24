@extends('layout')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="page-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-signpost-split"></i>
        </div>
        <h2 class="hero-title">Jalur Pendakian Gunung Merbabu</h2>
        <p class="hero-subtitle">
            Gunung Merbabu memiliki beberapa jalur pendakian resmi dengan karakter dan tingkat kesulitan berbeda
        </p>
    </div>
</div>

{{-- ================= JALUR PENDAKIAN ================= --}}
<div class="container content-section">
    <div class="section-header">
        <h3 class="section-title">Pilih Jalur Pendakian</h3>
        <p class="section-subtitle">Sesuaikan dengan kemampuan fisik dan pengalaman Anda</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        @php
        $jalur = [
            [
                'nama' => 'Jalur Selo',
                'icon' => 'sunrise',
                'badge' => 'Populer',
                'badge_color' => '#22c55e',
                'desc' => 'Jalur favorit pendaki dengan savana luas dan panorama terbuka. Cocok untuk pemula hingga menengah.',
                'waktu' => '5-6 jam',
                'jarak' => '8 km',
                'tingkat' => 'Menengah'
            ],
            [
                'nama' => 'Jalur Suwanting',
                'icon' => 'arrow-up-right',
                'badge' => 'Menantang',
                'badge_color' => '#f59e0b',
                'desc' => 'Jalur dengan tanjakan panjang serta trek yang cukup ekstrem. Untuk pendaki berpengalaman.',
                'waktu' => '6-7 jam',
                'jarak' => '10 km',
                'tingkat' => 'Sulit'
            ],
            [
                'nama' => 'Jalur Wekas',
                'icon' => 'person-walking',
                'badge' => 'Pemula',
                'badge_color' => '#3b82f6',
                'desc' => 'Jalur resmi yang relatif ramah untuk pendaki pemula. Trek landai dan pemandangan indah.',
                'waktu' => '4-5 jam',
                'jarak' => '6 km',
                'tingkat' => 'Mudah'
            ],
            [
                'nama' => 'Jalur Cuntel',
                'icon' => 'exclamation-triangle',
                'badge' => 'Ekstrem',
                'badge_color' => '#ef4444',
                'desc' => 'Jalur singkat dengan medan curam dan tingkat kesulitan tinggi. Hanya untuk pendaki ahli.',
                'waktu' => '4-5 jam',
                'jarak' => '5 km',
                'tingkat' => 'Sangat Sulit'
            ],
            [
                'nama' => 'Jalur Thekelan',
                'icon' => 'tree',
                'badge' => 'Klasik',
                'badge_color' => '#64748b',
                'desc' => 'Jalur klasik dengan suasana hutan pinus dan perjalanan panjang. Cocok untuk pendaki menengah.',
                'waktu' => '6-7 jam',
                'jarak' => '9 km',
                'tingkat' => 'Menengah'
            ]
        ];
        @endphp
        
        @foreach($jalur as $item)
        <div class="col-lg-4 col-md-6">
            <div class="trail-card">
                <div class="trail-header">
                    <div class="trail-icon">
                        <i class="bi bi-{{ $item['icon'] }}"></i>
                    </div>
                    <span class="trail-badge" style="background: {{ $item['badge_color'] }};">{{ $item['badge'] }}</span>
                </div>
                <div class="trail-body">
                    <h5 class="trail-name">{{ $item['nama'] }}</h5>
                    <p class="trail-desc">{{ $item['desc'] }}</p>
                    <div class="trail-info">
                        <div class="info-item">
                            <i class="bi bi-clock"></i>
                            <span>{{ $item['waktu'] }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $item['jarak'] }}</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-bar-chart"></i>
                            <span>{{ $item['tingkat'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ================= INFO SECTION ================= --}}
<div class="info-section">
    <div class="container">
        <div class="info-box">
            <div class="info-icon-box">
                <i class="bi bi-info-circle"></i>
            </div>
            <div class="info-content">
                <h5>Pilih Jalur Sesuai Kemampuan</h5>
                <p>Utamakan keselamatan dan jaga kelestarian alam selama pendakian. Pastikan kondisi fisik Anda prima sebelum memulai pendakian.</p>
            </div>
        </div>
    </div>
</div>

{{-- ================= CTA SECTION ================= --}}
<div class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h4 class="cta-title">Sudah Tentukan Jalur?</h4>
            <p class="cta-text">Booking tiket pendakian sekarang dan siapkan petualangan Anda</p>
            @auth
                <a href="{{ route('pemesanan.create') }}" class="cta-button">
                    <i class="bi bi-ticket-perforated"></i> Booking Sekarang
                </a>
            @else
                <a href="{{ route('login') }}" class="cta-button">
                    <i class="bi bi-ticket-perforated"></i> Booking Sekarang
                </a>
            @endauth
        </div>
    </div>
</div>

<style>
/* Hero Section */
.page-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 140px 0 80px;
    text-align: center;
    overflow: hidden;
}

.page-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff08" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
}

.hero-content { position: relative; z-index: 1; }

.hero-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 40px;
    color: #fff;
    box-shadow: 0 10px 40px rgba(245, 158, 11, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.hero-title { color: #fff; font-size: 2.5rem; font-weight: 700; margin-bottom: 15px; }
.hero-subtitle { color: #94a3b8; font-size: 1.1rem; max-width: 700px; margin: 0 auto; }

/* Content Section */
.content-section { padding: 80px 0; }

.section-header { text-align: center; margin-bottom: 50px; }
.section-title { font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
.section-subtitle { color: #64748b; font-size: 16px; }

/* Trail Card */
.trail-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s;
    height: 100%;
}

.trail-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.trail-header {
    position: relative;
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.trail-icon {
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: #facc15;
}

.trail-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #fff;
}

.trail-body {
    padding: 25px;
}

.trail-name {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}

.trail-desc {
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.trail-info {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.trail-info .info-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #64748b;
    background: #f1f5f9;
    padding: 6px 12px;
    border-radius: 20px;
}

.trail-info .info-item i {
    color: #3b82f6;
}

/* Info Section */
.info-section {
    background: #f8fafc;
    padding: 50px 0;
}

.info-box {
    display: flex;
    align-items: center;
    gap: 25px;
    background: #fff;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.info-icon-box {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #fff;
    flex-shrink: 0;
}

.info-content h5 { font-weight: 600; color: #1e293b; margin-bottom: 8px; }
.info-content p { color: #64748b; margin: 0; font-size: 15px; }

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 80px 0;
}

.cta-content { text-align: center; }
.cta-title { color: #fff; font-size: 2rem; font-weight: 700; margin-bottom: 15px; }
.cta-text { color: #94a3b8; font-size: 16px; margin-bottom: 30px; }

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 36px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(34, 197, 94, 0.3);
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(34, 197, 94, 0.4);
    color: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title { font-size: 1.8rem; }
    .info-box { flex-direction: column; text-align: center; }
    .cta-title { font-size: 1.5rem; }
}
</style>

@endsection
