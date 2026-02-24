@extends('layout')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="page-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-backpack3"></i>
        </div>
        <h2 class="hero-title">Perlengkapan Wajib Pendakian</h2>
        <p class="hero-subtitle">
            Pastikan Anda membawa perlengkapan yang memadai untuk keselamatan dan kenyamanan selama pendakian
        </p>
    </div>
</div>

{{-- ================= ISI PERLENGKAPAN ================= --}}
<div class="container content-section">
    <div class="section-header">
        <h3 class="section-title">Daftar Perlengkapan</h3>
        <p class="section-subtitle">Perlengkapan wajib yang harus dibawa setiap pendaki</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        @php
        $perlengkapan = [
            ['icon' => 'backpack', 'title' => 'Tas Carrier', 'desc' => 'Tas gunung untuk membawa seluruh perlengkapan pendakian', 'color' => '#22c55e'],
            ['icon' => 'shield-check', 'title' => 'Sepatu Safety Gunung', 'desc' => 'Melindungi kaki dan menjaga kestabilan saat pendakian', 'color' => '#3b82f6'],
            ['icon' => 'cloud-rain', 'title' => 'Jas Hujan', 'desc' => 'Mengantisipasi cuaca ekstrem dan hujan', 'color' => '#06b6d4'],
            ['icon' => 'lightning-charge', 'title' => 'Senter / Headlamp', 'desc' => 'Penerangan saat malam hari atau kondisi gelap', 'color' => '#f59e0b'],
            ['icon' => 'cup-hot', 'title' => 'Logistik & Air', 'desc' => 'Bekal makanan dan minuman selama pendakian', 'color' => '#ef4444'],
            ['icon' => 'bandaid', 'title' => 'P3K', 'desc' => 'Peralatan pertolongan pertama saat keadaan darurat', 'color' => '#ec4899'],
            ['icon' => 'thermometer-snow', 'title' => 'Jaket Tebal', 'desc' => 'Melindungi tubuh dari suhu dingin di puncak', 'color' => '#8b5cf6'],
            ['icon' => 'house', 'title' => 'Tenda', 'desc' => 'Tempat istirahat jika bermalam di gunung', 'color' => '#14b8a6'],
            ['icon' => 'bag-check', 'title' => 'Plastik Sampah', 'desc' => 'Untuk membawa turun sampah pribadi', 'color' => '#84cc16'],
        ];
        @endphp
        
        @foreach($perlengkapan as $item)
        <div class="col-lg-4 col-md-6">
            <div class="equipment-card">
                <div class="equipment-icon" style="background: linear-gradient(135deg, {{ $item['color'] }}, {{ $item['color'] }}dd);">
                    <i class="bi bi-{{ $item['icon'] }}"></i>
                </div>
                <h5 class="equipment-title">{{ $item['title'] }}</h5>
                <p class="equipment-desc">{{ $item['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ================= CTA SECTION ================= --}}
<div class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h4 class="cta-title">Perlengkapan Lengkap, Pendakian Aman</h4>
            <p class="cta-text">Pastikan semua perlengkapan sudah siap sebelum memulai pendakian</p>
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

.hero-content {
    position: relative;
    z-index: 1;
}

.hero-icon {
    width: 90px;
    height: 90px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 40px;
    color: #fff;
    box-shadow: 0 10px 40px rgba(34, 197, 94, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.hero-title {
    color: #fff;
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-subtitle {
    color: #94a3b8;
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
}

/* Content Section */
.content-section {
    padding: 80px 0;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
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

/* Equipment Card */
.equipment-card {
    background: #fff;
    border-radius: 20px;
    padding: 35px 25px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s;
    height: 100%;
}

.equipment-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.equipment-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 36px;
    color: #fff;
}

.equipment-title {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 12px;
}

.equipment-desc {
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 80px 0;
}

.cta-content {
    text-align: center;
}

.cta-title {
    color: #fff;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-text {
    color: #94a3b8;
    font-size: 16px;
    margin-bottom: 30px;
}

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
    .hero-title {
        font-size: 1.8rem;
    }
    
    .cta-title {
        font-size: 1.5rem;
    }
}
</style>

@endsection
