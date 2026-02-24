@extends('layout')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="page-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-clipboard-check"></i>
        </div>
        <h2 class="hero-title">Persyaratan Pendaki</h2>
        <p class="hero-subtitle">
            Demi keselamatan pendaki dan kelestarian alam Gunung Merbabu, setiap pendaki wajib mematuhi ketentuan resmi yang berlaku
        </p>
    </div>
</div>

{{-- ================= PERSYARATAN ================= --}}
<div class="container content-section">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-10">
        
            {{-- Persyaratan Umum --}}
            <div class="requirement-card green">
                <div class="card-header-req">
                    <div class="header-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5 class="header-title">Persyaratan Umum</h5>
                </div>
                <div class="card-body-req">
                    <ul class="req-list">
                        <li><i class="bi bi-check-circle-fill"></i> Pendaki wajib berusia minimal 15 tahun</li>
                        <li><i class="bi bi-check-circle-fill"></i> Kondisi fisik pendaki harus sehat</li>
                        <li><i class="bi bi-check-circle-fill"></i> Dilarang membawa makanan atau minuman beralkohol</li>
                        <li><i class="bi bi-check-circle-fill"></i> Wajib membawa surat keterangan sehat (usia di atas 50 tahun)</li>
                    </ul>
                </div>
            </div>
            
            {{-- Dokumen --}}
            <div class="requirement-card blue">
                <div class="card-header-req">
                    <div class="header-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5 class="header-title">Dokumen yang Harus Dibawa</h5>
                </div>
                <div class="card-body-req">
                    <ul class="req-list">
                        <li><i class="bi bi-check-circle-fill"></i> Fotokopi KTP, SIM, atau Kartu Pelajar</li>
                        <li><i class="bi bi-check-circle-fill"></i> Bukti registrasi Simaksi (cetak atau digital)</li>
                        <li><i class="bi bi-check-circle-fill"></i> Tiket masuk kawasan</li>
                    </ul>
                </div>
            </div>
            
            {{-- Perlengkapan Wajib --}}
            <div class="requirement-card yellow">
                <div class="card-header-req">
                    <div class="header-icon">
                        <i class="bi bi-backpack"></i>
                    </div>
                    <h5 class="header-title">Perlengkapan Wajib</h5>
                </div>
                <div class="card-body-req">
                    <div class="req-grid">
                        <ul class="req-list">
                            <li><i class="bi bi-check-circle-fill"></i> Jaket atau sweater tebal</li>
                            <li><i class="bi bi-check-circle-fill"></i> Sepatu trekking</li>
                            <li><i class="bi bi-check-circle-fill"></i> Tenda (jika menginap)</li>
                            <li><i class="bi bi-check-circle-fill"></i> Senter atau headlamp</li>
                        </ul>
                        <ul class="req-list">
                            <li><i class="bi bi-check-circle-fill"></i> Emergency Blanket (Wajib)</li>
                            <li><i class="bi bi-check-circle-fill"></i> Air minum minimal 2 liter</li>
                            <li><i class="bi bi-check-circle-fill"></i> Obat-obatan pribadi</li>
                            <li><i class="bi bi-check-circle-fill"></i> Plastik sampah</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            {{-- Kewajiban Pendaki --}}
            <div class="requirement-card pink">
                <div class="card-header-req">
                    <div class="header-icon">
                        <i class="bi bi-shield-exclamation"></i>
                    </div>
                    <h5 class="header-title">Kewajiban Pendaki</h5>
                </div>
                <div class="card-body-req">
                    <div class="req-grid">
                        <ul class="req-list">
                            <li><i class="bi bi-check-circle-fill"></i> Wajib melapor ke petugas pos pendakian</li>
                            <li><i class="bi bi-check-circle-fill"></i> Wajib mengikuti jalur pendakian yang ditentukan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Dilarang membuat api unggun</li>
                        </ul>
                        <ul class="req-list">
                            <li><i class="bi bi-check-circle-fill"></i> Dilarang mengambil flora dan fauna</li>
                            <li><i class="bi bi-check-circle-fill"></i> Wajib menjaga kebersihan kawasan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Wajib mengikuti protokol kesehatan</li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

{{-- ================= CTA SECTION ================= --}}
<div class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h4 class="cta-title">Siap Mendaki?</h4>
            <p class="cta-text">Pastikan Anda memenuhi semua persyaratan sebelum melakukan pendakian</p>
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
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 40px;
    color: #fff;
    box-shadow: 0 10px 40px rgba(59, 130, 246, 0.3);
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
}

.hero-subtitle {
    color: #94a3b8;
    font-size: 1.1rem;
    max-width: 700px;
    margin: 0 auto;
}

/* Content Section */
.content-section {
    padding: 80px 0;
}

/* Requirement Cards */
.requirement-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-bottom: 25px;
    transition: all 0.3s;
}

.requirement-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.card-header-req {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px 25px;
}

.requirement-card.green .card-header-req { background: linear-gradient(135deg, #22c55e, #16a34a); }
.requirement-card.blue .card-header-req { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
.requirement-card.yellow .card-header-req { background: linear-gradient(135deg, #f59e0b, #d97706); }
.requirement-card.pink .card-header-req { background: linear-gradient(135deg, #ec4899, #db2777); }

.header-icon {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: #fff;
}

.header-title {
    color: #fff;
    font-weight: 600;
    margin: 0;
}

.card-body-req {
    padding: 25px;
}

.req-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.req-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    color: #475569;
    font-size: 15px;
}

.req-list li i {
    color: #22c55e;
    font-size: 16px;
    margin-top: 2px;
}

.req-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
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
    
    .req-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-title {
        font-size: 1.5rem;
    }
}
</style>

@endsection
