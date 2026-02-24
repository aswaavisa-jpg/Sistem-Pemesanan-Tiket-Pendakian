@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="detail-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-person-vcard"></i>
        </div>
        <h2 class="hero-title">Detail Pemesanan</h2>
        <p class="hero-subtitle">Lihat data anggota pendaki yang sudah terdaftar</p>
    </div>
</div>

<div class="container my-5">
    @if($detailpendaki->isNotEmpty())
        <!-- Header Info -->
        <div class="header-card mb-4">
            <div class="header-info">
                <h5 class="header-title">
                    <i class="bi bi-people-fill"></i> Daftar Anggota Pendaki
                </h5>
                <p class="header-subtitle">Total: {{ $detailpendaki->count() }} anggota terdaftar</p>
            </div>
        </div>

        <!-- Pendaki Cards Grid -->
        <div class="pendaki-grid">
            @foreach($detailpendaki as $dp)
            <div class="pendaki-card">
                <div class="pendaki-header">
                    <div class="pendaki-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="pendaki-name">
                        <h5>{{ $dp->pendaki->nama }}</h5>
                        <span class="jalur-badge">
                            <i class="bi bi-signpost-split"></i> {{ $dp->pemesanan->jalur_pendakian }}
                        </span>
                    </div>
                </div>

                <div class="pendaki-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">NIK</span>
                            <span class="info-value">{{ $dp->pendaki->nik }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Jenis Kelamin</span>
                            <span class="info-value">{{ $dp->pendaki->jenis_kelamin }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">No HP</span>
                            <span class="info-value">{{ $dp->pendaki->no_hp }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Lahir</span>
                            <span class="info-value">{{ $dp->pendaki->tanggal_lahir ? \Carbon\Carbon::parse($dp->pendaki->tanggal_lahir)->format('d M Y') : '-' }}</span>
                        </div>
                    </div>

                    <div class="alamat-section">
                        <span class="alamat-label">
                            <i class="bi bi-geo-alt"></i> Alamat
                        </span>
                        <p class="alamat-value">
                            {{ collect([
                                $dp->pendaki->alamat,
                                $dp->pendaki->dusun,
                                'RT/RW '.$dp->pendaki->rt_rw,
                                $dp->pendaki->desa,
                                $dp->pendaki->kecamatan,
                                $dp->pendaki->kabupaten,
                                $dp->pendaki->provinsi
                            ])->filter()->implode(', ') ?: '-' }}
                        </p>
                    </div>

                    <div class="tanggal-section">
                        <div class="tanggal-item">
                            <i class="bi bi-arrow-up-circle"></i>
                            <div>
                                <span class="tanggal-label">Naik</span>
                                <span class="tanggal-value">{{ \Carbon\Carbon::parse($dp->pemesanan->tgl_naik)->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="tanggal-item">
                            <i class="bi bi-arrow-down-circle"></i>
                            <div>
                                <span class="tanggal-label">Turun</span>
                                <span class="tanggal-value">{{ \Carbon\Carbon::parse($dp->pemesanan->tgl_turun)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pendaki-footer">
                    <!-- Tombol hapus di detail pemesanan dihilangkan sesuai permintaan -->
                </div>
            </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="empty-title">Belum Ada Data Pendaki</h5>
            <p class="empty-text">Anda belum memiliki data pendaki yang terdaftar.</p>
            @auth
                <a href="{{ route('pemesanan.create') }}" class="btn-empty">
                    <i class="bi bi-plus-circle"></i> Buat Pemesanan Baru
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-empty">
                    <i class="bi bi-plus-circle"></i> Buat Pemesanan Baru
                </a>
            @endauth
        </div>
    @endif
</div>

<style>
/* Hero Section */
.detail-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.detail-hero::before {
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
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #facc15, #f59e0b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 36px;
    color: #0f172a;
    box-shadow: 0 10px 40px rgba(250, 204, 21, 0.3);
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
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.hero-subtitle {
    color: #94a3b8;
    font-size: 1.1rem;
    margin: 0;
}

/* Header Card */
.header-card {
    background: #fff;
    padding: 20px 25px;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.header-title {
    font-weight: 700;
    color: #1e293b;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-subtitle {
    color: #64748b;
    font-size: 14px;
    margin: 5px 0 0 0;
}

/* Pendaki Grid */
.pendaki-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 25px;
}

/* Pendaki Card */
.pendaki-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.pendaki-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
}

.pendaki-header {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 25px;
    display: flex;
    align-items: center;
    gap: 15px;
}

.pendaki-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #facc15, #f59e0b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #0f172a;
    flex-shrink: 0;
}

.pendaki-name h5 {
    color: #fff;
    font-weight: 700;
    margin: 0 0 8px 0;
    font-size: 18px;
}

.jalur-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.15);
    color: #fff;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
}

.pendaki-body {
    padding: 25px;
    flex: 1;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.info-label {
    font-size: 12px;
    color: #64748b;
}

.info-value {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.alamat-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 20px;
}

.alamat-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 8px;
}

.alamat-value {
    color: #1e293b;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}

.tanggal-section {
    display: flex;
    gap: 20px;
}

.tanggal-item {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    background: #eff6ff;
    padding: 12px 15px;
    border-radius: 10px;
}

.tanggal-item i {
    font-size: 24px;
    color: #3b82f6;
}

.tanggal-label {
    display: block;
    font-size: 11px;
    color: #64748b;
}

.tanggal-value {
    font-weight: 600;
    color: #1e293b;
    font-size: 13px;
}

.pendaki-footer {
    display: flex;
    gap: 10px;
    padding: 15px 25px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.btn-action {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 12px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
}

.btn-edit {
    background: #fef3c7;
    color: #b45309;
}

.btn-edit:hover {
    background: #fde68a;
    color: #92400e;
}

.btn-delete {
    background: #fee2e2;
    color: #dc2626;
}

.btn-delete:hover {
    background: #fecaca;
    color: #b91c1c;
}

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 20px;
    padding: 80px 40px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.empty-icon {
    width: 100px;
    height: 100px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 25px;
    font-size: 48px;
    color: #94a3b8;
}

.empty-title {
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 10px;
}

.empty-text {
    color: #64748b;
    margin-bottom: 25px;
}

.btn-empty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    color: #fff;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .pendaki-grid {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .tanggal-section {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

@endsection
