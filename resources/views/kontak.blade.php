@extends('layout')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div class="page-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-headset"></i>
        </div>
        <h2 class="hero-title">Hubungi Kami</h2>
        <p class="hero-subtitle">
            Informasi dan bantuan seputar pendakian Gunung Merbabu
        </p>
    </div>
</div>

{{-- ================= KONTAK INFO ================= --}}
<div class="container content-section">
    <div class="section-header">
        <h3 class="section-title">Balai Taman Nasional Gunung Merbabu</h3>
        <p class="section-subtitle">Hubungi kami melalui kontak berikut untuk informasi lebih lanjut</p>
    </div>
    
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="contact-icon" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h5 class="contact-title">Alamat</h5>
                <p class="contact-text">Boyolali, Jawa Tengah<br>Indonesia</p>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="contact-icon" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                    <i class="bi bi-telephone"></i>
                </div>
                <h5 class="contact-title">Telepon Basecamp</h5>
                <p class="contact-text">0857-3125-0559</p>
                <a href="tel:085731250559" class="contact-link">
                    <i class="bi bi-telephone-outbound"></i> Hubungi Sekarang
                </a>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="contact-card">
                <div class="contact-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                    <i class="bi bi-envelope"></i>
                </div>
                <h5 class="contact-title">Email</h5>
                <p class="contact-text">info@merbabu.id</p>
                <a href="mailto:info@merbabu.id" class="contact-link">
                    <i class="bi bi-envelope-at"></i> Kirim Email
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ================= SOSIAL MEDIA ================= --}}
<div class="social-section">
    <div class="container">
        <div class="section-header light">
            <h3 class="section-title">Ikuti Kami</h3>
            <p class="section-subtitle">Dapatkan update terbaru seputar pendakian</p>
        </div>
        
        <div class="social-links">
            <a href="https://www.instagram.com/pendakian.merbabu/" target="_blank" class="social-item">
                <i class="bi bi-instagram"></i>
                <div class="d-flex flex-column align-items-start">
                    <span class="platform-name">Instagram</span>
                    <small class="handle-text">pendakian.merbabu</small>
                </div>
            </a>
            <a href="https://www.facebook.com/basecamp.merbabu" target="_blank" class="social-item">
                <i class="bi bi-facebook"></i>
                <div class="d-flex flex-column align-items-start">
                    <span class="platform-name">Facebook</span>
                    <small class="handle-text">basecamp.merbabu</small>
                </div>
            </a>
            <a href="https://wa.me/6285731250559" target="_blank" class="social-item">
                <i class="bi bi-whatsapp"></i>
                <div class="d-flex flex-column align-items-start">
                    <span class="platform-name">WhatsApp</span>
                    <small class="handle-text">0857-3125-0559</small>
                </div>
            </a>
            <a href="https://www.youtube.com/@pendakian_gunungmerbabu" target="_blank" class="social-item">
                <i class="bi bi-youtube"></i>
                <div class="d-flex flex-column align-items-start">
                    <span class="platform-name">YouTube</span>
                    <small class="handle-text">pendakian_gunungmerbabu</small>
                </div>
            </a>
        </div>
    </div>
</div>

{{-- ================= JAM OPERASIONAL ================= --}}
<div class="container info-section">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-6">
            <div class="hours-card">
                <div class="hours-header">
                    <i class="bi bi-clock"></i>
                    <h5>Jam Operasional</h5>
                </div>
                <div class="hours-body">
                    <div class="hours-row">
                        <span>Senin - Jumat</span>
                        <span class="hours-time">08:00 - 17:00 WIB</span>
                    </div>
                    <div class="hours-row">
                        <span>Sabtu - Minggu</span>
                        <span class="hours-time">07:00 - 18:00 WIB</span>
                    </div>
                    <div class="hours-row">
                        <span>Hari Libur Nasional</span>
                        <span class="hours-time">07:00 - 18:00 WIB</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="hours-card">
                <div class="hours-header">
                    <i class="bi bi-info-circle"></i>
                    <h5>Informasi Penting</h5>
                </div>
                <div class="hours-body">
                    <ul class="info-list">
                        <li><i class="bi bi-check-circle-fill"></i> Pendaftaran online buka 24 jam</li>
                        <li><i class="bi bi-check-circle-fill"></i> Konfirmasi pembayaran maks 1x24 jam</li>
                        <li><i class="bi bi-check-circle-fill"></i> Lapor ke pos paling lambat jam 14:00 WIB</li>
                    </ul>
                </div>
            </div>
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
    background: linear-gradient(135deg, #ec4899, #db2777);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 40px;
    color: #fff;
    box-shadow: 0 10px 40px rgba(236, 72, 153, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.hero-title { color: #fff; font-size: 2.5rem; font-weight: 700; margin-bottom: 15px; }
.hero-subtitle { color: #94a3b8; font-size: 1.1rem; max-width: 600px; margin: 0 auto; }

/* Content Section */
.content-section { padding: 80px 0; }

.section-header { text-align: center; margin-bottom: 50px; }
.section-header.light .section-title, .section-header.light .section-subtitle { color: #fff; }
.section-title { font-size: 2rem; font-weight: 700; color: #1e293b; margin-bottom: 10px; }
.section-subtitle { color: #64748b; font-size: 16px; }

/* Contact Card */
.contact-card {
    background: #fff;
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s;
    height: 100%;
}

.contact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.12);
}

.contact-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 36px;
    color: #fff;
}

.contact-title { font-weight: 700; color: #1e293b; margin-bottom: 12px; }
.contact-text { color: #64748b; font-size: 15px; margin-bottom: 15px; }

.contact-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #3b82f6;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.contact-link:hover { color: #1d4ed8; gap: 12px; }

/* Social Section */
.social-section {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 80px 0;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.social-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50px;
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
}

.social-item i { font-size: 24px; }

.platform-name { font-weight: 700; font-size: 15px; }
.handle-text { font-size: 11px; opacity: 0.8; margin-top: -2px; }

.social-item:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-3px);
    color: #facc15;
}

/* Info Section */
.info-section { padding: 80px 0; background: #f8fafc; }

.hours-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
    height: 100%;
}

.hours-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 25px;
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    color: #fff;
}

.hours-header i { font-size: 24px; color: #facc15; }
.hours-header h5 { margin: 0; font-weight: 600; }

.hours-body { padding: 25px; }

.hours-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    color: #64748b;
}

.hours-row:last-child { border-bottom: none; }
.hours-time { font-weight: 600; color: #1e293b; }

.info-list { list-style: none; padding: 0; margin: 0; }
.info-list li {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    color: #64748b;
}
.info-list li i { color: #22c55e; font-size: 18px; }

/* CTA Section */
.cta-section {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    padding: 80px 0;
}

.cta-content { text-align: center; }
.cta-title { color: #fff; font-size: 2rem; font-weight: 700; margin-bottom: 15px; }
.cta-text { color: rgba(255,255,255,0.9); font-size: 16px; margin-bottom: 30px; }

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 36px;
    background: #fff;
    color: #16a34a;
    border-radius: 50px;
    font-weight: 600;
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
@media (max-width: 768px) {
    .hero-title { font-size: 1.8rem; }
    .social-links { flex-direction: column; align-items: center; }
    .cta-title { font-size: 1.5rem; }
}
</style>

@endsection
