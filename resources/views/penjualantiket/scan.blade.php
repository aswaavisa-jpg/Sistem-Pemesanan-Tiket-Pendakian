@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="scan-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-qr-code-scan"></i>
        </div>
        <h2 class="hero-title">Informasi Tiket Pendakian</h2>
        <p class="hero-subtitle">Kode Tiket: {{ $transaksi->kode_tiket }}</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Status Pembayaran -->
            <div class="status-alert {{ $transaksi->isVerified() ? 'status-verified' : ($transaksi->isPending() ? 'status-pending' : 'status-rejected') }} mb-4">
                <div class="status-icon">
                    @if($transaksi->isVerified())
                        <i class="bi bi-check-circle-fill"></i>
                    @elseif($transaksi->isPending())
                        <i class="bi bi-clock-history"></i>
                    @else
                        <i class="bi bi-x-circle-fill"></i>
                    @endif
                </div>
                <div class="status-content">
                    <strong>
                        @if($transaksi->isVerified())
                            Pembayaran Terverifikasi
                        @elseif($transaksi->isPending())
                            Menunggu Verifikasi Pembayaran
                        @else
                            Pembayaran Ditolak
                        @endif
                    </strong>
                    <p>
                        @if($transaksi->isVerified())
                            Tiket ini telah terverifikasi dan siap digunakan.
                        @elseif($transaksi->isPending())
                            Pembayaran sedang diproses dan menunggu verifikasi admin.
                        @else
                            Pembayaran ditolak. Pendaki perlu mengunggah ulang bukti pembayaran.
                        @endif
                    </p>
                </div>
            </div>

            <!-- Informasi Transaksi -->
            <div class="scan-card mb-4">
                <div class="card-header-custom">
                    <i class="bi bi-file-text"></i>
                    <span>Informasi Transaksi</span>
                </div>
                <div class="card-body-custom">
                    <div class="info-list">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-upc-scan"></i> Kode Tiket</span>
                            <span class="info-value code">{{ $transaksi->kode_tiket }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-signpost-2"></i> Jalur Pendakian</span>
                            <span class="info-value">{{ optional($transaksi->pemesanan)->jalur_pendakian ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-calendar-event"></i> Tanggal Naik</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_pendakian)->format('d M Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-calendar-check"></i> Tanggal Turun</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse(optional($transaksi->pemesanan)->tgl_turun ?? $transaksi->tanggal_pendakian)->format('d M Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-ticket-perforated"></i> Jumlah Tiket</span>
                            <span class="info-value">{{ $transaksi->jumlah_tiket }} tiket</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-cash-stack"></i> Total Harga</span>
                            <span class="info-value" style="color: #22c55e; font-size: 18px;">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-credit-card"></i> Metode Pembayaran</span>
                            <span class="info-value">{{ $transaksi->metode_pembayaran ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-patch-check"></i> Status Pembayaran</span>
                            <span class="status-badge {{ $transaksi->isVerified() ? 'verified' : ($transaksi->isPending() ? 'pending' : 'rejected') }}">
                                @if($transaksi->isVerified())
                                    <i class="bi bi-check-circle"></i> Terverifikasi
                                @elseif($transaksi->isPending())
                                    <i class="bi bi-clock"></i> Menunggu Verifikasi
                                @else
                                    <i class="bi bi-x-circle"></i> Ditolak
                                @endif
                            </span>
                        </div>
                        @if($transaksi->isVerified() && $transaksi->verifiedBy)
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-person-check"></i> Diverifikasi Oleh</span>
                            <span class="info-value">{{ $transaksi->verifiedBy->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-clock-history"></i> Waktu Verifikasi</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->verified_at)->format('d M Y, H:i') }} WIB</span>
                        </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-clock"></i> Tanggal Transaksi</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pendaki -->
            @if($transaksi->pemesanan && $transaksi->pemesanan->pendakis && $transaksi->pemesanan->pendakis->count() > 0)
            <div class="scan-card mb-4">
                <div class="card-header-custom" style="background: linear-gradient(135deg, #059669, #047857);">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Pendaki</span>
                </div>
                <div class="card-body-custom">
                    @foreach($transaksi->pemesanan->pendakis as $index => $detail)
                    @if($detail->pendaki)
                    <div class="pendaki-card {{ !$loop->last ? 'mb-3' : '' }}">
                        <div class="pendaki-header-scan">
                            <div class="pendaki-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="pendaki-info">
                                <strong>{{ $detail->pendaki->nama }}</strong>
                                <span class="pendaki-nik">NIK: {{ $detail->pendaki->nik }}</span>
                            </div>
                            @if($detail->status_pendakian)
                            <span class="status-badge-small {{ $detail->status_pendakian == 'aktif' ? 'aktif' : ($detail->status_pendakian == 'selesai' ? 'selesai' : 'batal') }}">
                                {{ ucfirst($detail->status_pendakian) }}
                            </span>
                            @endif
                        </div>
                        <div class="pendaki-details">
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Jenis Kelamin</span>
                                    <span class="detail-value">{{ $detail->pendaki->jenis_kelamin ?? '-' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Tanggal Lahir</span>
                                    <span class="detail-value">{{ $detail->pendaki->tanggal_lahir ? \Carbon\Carbon::parse($detail->pendaki->tanggal_lahir)->format('d M Y') : '-' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">No HP</span>
                                    <span class="detail-value">{{ $detail->pendaki->no_hp ?? '-' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label text-danger">No Darurat</span>
                                    <span class="detail-value text-danger fw-bold">{{ $detail->pendaki->no_hp_darurat ?? '-' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Alamat</span>
                                    <span class="detail-value">
                                        {{ collect([$detail->pendaki->dusun, $detail->pendaki->desa, $detail->pendaki->kecamatan, $detail->pendaki->kabupaten, $detail->pendaki->provinsi])->filter()->implode(', ') ?: '-' }}
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Dokumen</span>
                                    <div class="d-flex gap-2 mt-1">
                                        @if($detail->pendaki->foto_ktp)
                                            <a href="{{ asset('storage/' . $detail->pendaki->foto_ktp) }}" target="_blank" class="badge bg-primary text-decoration-none">
                                                <i class="bi bi-person-vcard"></i> KTP
                                            </a>
                                        @endif
                                        @if($detail->pendaki->foto_selfie)
                                            <a href="{{ asset('storage/' . $detail->pendaki->foto_selfie) }}" target="_blank" class="badge bg-info text-dark text-decoration-none">
                                                <i class="bi bi-camera"></i> Selfie
                                            </a>
                                        @endif
                                        @if(!$detail->pendaki->foto_ktp && !$detail->pendaki->foto_selfie)
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Pemesan -->
            @if($transaksi->pemesanan && $transaksi->pemesanan->user)
            <div class="scan-card mb-4">
                <div class="card-header-custom" style="background: linear-gradient(135deg, #7c3aed, #6d28d9);">
                    <i class="bi bi-person-badge"></i>
                    <span>Data Pemesan</span>
                </div>
                <div class="card-body-custom">
                    <div class="info-list">
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-person"></i> Nama</span>
                            <span class="info-value">{{ $transaksi->pemesanan->user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="bi bi-envelope"></i> Email</span>
                            <span class="info-value">{{ $transaksi->pemesanan->user->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<style>
/* Hero Section */
.scan-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.scan-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff08" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
}

.hero-content { position: relative; z-index: 1; }

.hero-icon {
    width: 80px; height: 80px;
    background: linear-gradient(135deg, #facc15, #f59e0b);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    font-size: 36px; color: #0f172a;
    box-shadow: 0 10px 40px rgba(250, 204, 21, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.hero-title { color: #fff; font-size: 2.2rem; font-weight: 700; margin-bottom: 10px; }
.hero-subtitle { color: #94a3b8; font-size: 1.1rem; margin: 0; }

/* Status Alert */
.status-alert { display: flex; gap: 15px; padding: 20px; border-radius: 16px; align-items: flex-start; }
.status-pending { background: #fef3c7; border: 1px solid #fde68a; }
.status-verified { background: #d1fae5; border: 1px solid #a7f3d0; }
.status-rejected { background: #fee2e2; border: 1px solid #fecaca; }
.status-icon { font-size: 28px; flex-shrink: 0; }
.status-pending .status-icon { color: #b45309; }
.status-verified .status-icon { color: #059669; }
.status-rejected .status-icon { color: #dc2626; }
.status-content strong { display: block; margin-bottom: 4px; }
.status-pending .status-content strong { color: #92400e; }
.status-verified .status-content strong { color: #065f46; }
.status-rejected .status-content strong { color: #991b1b; }
.status-content p { margin: 0; font-size: 14px; }
.status-pending .status-content p { color: #a16207; }
.status-verified .status-content p { color: #047857; }
.status-rejected .status-content p { color: #b91c1c; }

/* Scan Card */
.scan-card { background: #fff; border-radius: 20px; box-shadow: 0 10px 50px rgba(0,0,0,0.1); overflow: hidden; }
.card-header-custom { background: linear-gradient(135deg, #0f172a, #1e3a5f); color: #fff; padding: 20px 25px; font-weight: 600; font-size: 16px; display: flex; align-items: center; gap: 10px; }
.card-body-custom { padding: 30px; }

/* Info List */
.info-list { }
.info-row { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 8px; }
.info-row:last-child { border-bottom: none; }
.info-label { display: flex; align-items: center; gap: 10px; color: #64748b; font-size: 14px; }
.info-label i { color: #3b82f6; font-size: 18px; }
.info-value { font-weight: 600; color: #1e293b; font-size: 15px; }
.info-value.code { font-family: monospace; background: #f1f5f9; padding: 6px 12px; border-radius: 6px; font-size: 14px; }

/* Status Badge */
.status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 25px; font-size: 13px; font-weight: 600; }
.status-badge.pending { background: #fef3c7; color: #b45309; }
.status-badge.verified { background: #d1fae5; color: #059669; }
.status-badge.rejected { background: #fee2e2; color: #dc2626; }

/* Pendaki Card */
.pendaki-card { background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; overflow: hidden; transition: all 0.3s; }
.pendaki-card:hover { border-color: #3b82f6; box-shadow: 0 4px 20px rgba(59, 130, 246, 0.1); }

.pendaki-header-scan { display: flex; align-items: center; gap: 14px; padding: 18px 20px; background: linear-gradient(135deg, #f1f5f9, #e2e8f0); border-bottom: 1px solid #e2e8f0; }
.pendaki-avatar { width: 42px; height: 42px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 18px; flex-shrink: 0; }
.pendaki-info { flex: 1; }
.pendaki-info strong { display: block; color: #1e293b; font-size: 15px; }
.pendaki-nik { color: #64748b; font-size: 13px; }

.status-badge-small { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.status-badge-small.aktif { background: #dbeafe; color: #1d4ed8; }
.status-badge-small.selesai { background: #d1fae5; color: #059669; }
.status-badge-small.batal { background: #fee2e2; color: #dc2626; }

.pendaki-details { padding: 20px; }
.detail-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
.detail-item { }
.detail-label { display: block; font-size: 12px; color: #64748b; margin-bottom: 4px; }
.detail-value { display: block; font-weight: 600; color: #1e293b; font-size: 14px; }

/* Responsive */
@media (max-width: 768px) {
    .hero-title { font-size: 1.6rem; }
    .info-row { flex-direction: column; align-items: flex-start; gap: 4px; }
    .detail-grid { grid-template-columns: 1fr; }
    .pendaki-header-scan { flex-wrap: wrap; }
}
</style>

@endsection
