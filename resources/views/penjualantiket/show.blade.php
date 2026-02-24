@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="show-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-receipt"></i>
        </div>
        <h2 class="hero-title">Detail Transaksi</h2>
        <p class="hero-subtitle">Kode Tiket: {{ $transaksi->kode_tiket }}</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Status Alert -->
            <!-- Status Alert -->
            @if($transaksi->isPending() && $transaksi->bukti_pembayaran)
                <div class="status-alert status-pending mb-4">
                    <div class="status-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="status-content">
                        <strong>Menunggu Verifikasi Pembayaran</strong>
                        <p>Bukti pembayaran sedang diperiksa oleh admin. Mohon tunggu.</p>
                    </div>
                </div>
            @elseif($transaksi->isVerified())
                <div class="status-alert status-verified mb-4">
                    <div class="status-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="status-content">
                        <strong>Pembayaran Terverifikasi!</strong>
                        <p>Pembayaran Anda telah dikonfirmasi oleh admin. Anda dapat mencetak tiket.</p>
                    </div>
                </div>
            @elseif($transaksi->isRejected())
                <div class="status-alert status-rejected mb-4">
                    <div class="status-icon">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <div class="status-content">
                        <strong>Pembayaran Ditolak</strong>
                        <p>Silakan unggah ulang bukti pembayaran yang benar</p>
                    </div>
                </div>
            @endif

            <!-- Transaction Card -->
            <div class="transaction-card">
                <div class="card-header-custom">
                    <i class="bi bi-file-text"></i>
                    <span>Informasi Transaksi & Data Pendaki</span>
                </div>

                <div class="card-body-custom">
                    <div class="info-list">
                        <div class="info-row">
                            <span class="info-label">
                                <i class="bi bi-upc-scan"></i> Kode Tiket
                            </span>
                            <span class="info-value code">{{ $transaksi->kode_tiket }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="bi bi-signpost-2"></i> Jalur Pendakian
                            </span>
                            <span class="info-value">{{ $transaksi->nama_pendaki }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="bi bi-calendar-event"></i> Tanggal Pendakian
                            </span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_pendakian)->format('d M Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">
                                <i class="bi bi-ticket-perforated"></i> Jumlah Tiket
                            </span>
                            <span class="info-value">{{ $transaksi->jumlah_tiket }} tiket</span>
                        </div>
                    </div>

                    <!-- Data Pendaki Section -->
                    <div class="hiker-list-section mb-4">
                        <h6 class="border-bottom pb-2 mb-3 fw-bold text-secondary">
                            <i class="bi bi-people-fill me-2"></i>Daftar Pendaki
                        </h6>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pendaki</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No. HP</th>
                                        <th>No. Darurat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transaksi->pemesanan->pendakis as $index => $detail)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $detail->pendaki->nama }}
                                            <div class="small text-muted">NIK: {{ $detail->pendaki->nik }}</div>
                                        </td>
                                        <td>{{ $detail->pendaki->jenis_kelamin }}</td>
                                        <td>{{ $detail->pendaki->no_hp }}</td>
                                        <td class="text-danger fw-bold">{{ $detail->pendaki->no_hp_darurat ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="price-section">
                        <div class="price-row">
                            <span>Harga per Tiket</span>
                            <span>Rp 20.000</span>
                        </div>
                        <div class="price-row">
                            <span>Jumlah Tiket</span>
                            <span>{{ $transaksi->jumlah_tiket }}x</span>
                        </div>
                        <div class="price-total">
                            <span>Total Pembayaran</span>
                            <span class="total-value">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Scan QR Code Section -->
                    @if($transaksi->kode_tiket)
                    <div class="qrcode-section text-center mb-4 p-3 border rounded-4 bg-light">
                        <p class="text-muted small mb-2 fw-bold">SCAN QR CODE TIKET</p>
                        <div id="qrcode-detail" class="d-inline-block p-2 bg-white border rounded-3 shadow-sm" style="min-width: 160px; min-height: 160px; display: flex; align-items: center; justify-content: center;">
                            <span class="text-muted small loading-text">Memuat QR Code...</span>
                        </div>
                        <p class="text-muted small mt-2 mb-0">Scan untuk melihat detail pemesanan</p>
                        <p class="text-danger small mt-2 mb-0">
                            <i class="bi bi-wifi me-1"></i>
                            <strong>⚠️ Perhatian:</strong> Scan QR code harus menggunakan jaringan WiFi yang sama dengan server
                        </p>
                    </div>
                    @endif

                    <div class="status-section">
                        <span class="status-label">Status Pembayaran</span>
                        @if($transaksi->isPending())
                            @if($transaksi->bukti_pembayaran)
                                <span class="status-badge pending">
                                    <i class="bi bi-clock"></i> Menunggu Verifikasi
                                </span>
                            @else
                                <span class="status-badge" style="background: #e2e8f0; color: #64748b;">
                                    <i class="bi bi-wallet2"></i> Belum Dibayar
                                </span>
                            @endif
                        @elseif($transaksi->isVerified())
                            <span class="status-badge verified">
                                <i class="bi bi-check-circle"></i> Terverifikasi
                            </span>
                        @else
                            <span class="status-badge rejected">
                                <i class="bi bi-x-circle"></i> Ditolak
                            </span>
                        @endif
                    </div>
                </div>



                <div class="card-footer-custom">
                    <a href="{{ route('penjualantiket.index') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                <div class="footer-actions">
                        @if(!$transaksi->isVerified())
                            <a href="{{ route('penjualantiket.editPayment', $transaksi->id) }}" class="btn-pay">
                                <i class="bi bi-credit-card"></i> Bayar
                            </a>
                            <span class="btn-print-disabled" title="Pembayaran belum diverifikasi">
                                <i class="bi bi-printer"></i> Cetak Tiket
                            </span>
                        @else
                            <a href="{{ route('penjualantiket.print', $transaksi->id) }}" target="_blank" class="btn-print">
                                <i class="bi bi-printer"></i> Cetak Tiket
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Hero Section */
.show-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.show-hero::before {
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

/* Status Alert */
.status-alert {
    display: flex;
    gap: 15px;
    padding: 20px;
    border-radius: 16px;
    align-items: flex-start;
}

.status-pending {
    background: #fef3c7;
    border: 1px solid #fde68a;
}

.status-verified {
    background: #d1fae5;
    border: 1px solid #a7f3d0;
}

.status-rejected {
    background: #fee2e2;
    border: 1px solid #fecaca;
}

.status-icon {
    font-size: 28px;
    flex-shrink: 0;
}

.status-pending .status-icon { color: #b45309; }
.status-verified .status-icon { color: #059669; }
.status-rejected .status-icon { color: #dc2626; }

.status-content strong {
    display: block;
    margin-bottom: 4px;
}

.status-pending .status-content strong { color: #92400e; }
.status-verified .status-content strong { color: #065f46; }
.status-rejected .status-content strong { color: #991b1b; }

.status-content p {
    margin: 0;
    font-size: 14px;
}

.status-pending .status-content p { color: #a16207; }
.status-verified .status-content p { color: #047857; }
.status-rejected .status-content p { color: #b91c1c; }

/* Transaction Card */
.transaction-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header-custom {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    color: #fff;
    padding: 20px 25px;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-body-custom {
    padding: 30px;
}

/* Info List */
.info-list {
    margin-bottom: 25px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #64748b;
    font-size: 14px;
}

.info-label i {
    color: #3b82f6;
    font-size: 18px;
}

.info-value {
    font-weight: 600;
    color: #1e293b;
    font-size: 15px;
}

.info-value.code {
    font-family: monospace;
    background: #f1f5f9;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 14px;
}

/* Price Section */
.price-section {
    background: #f8fafc;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 25px;
}

.price-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    color: #64748b;
    font-size: 14px;
}

.price-total {
    display: flex;
    justify-content: space-between;
    padding-top: 15px;
    margin-top: 10px;
    border-top: 2px dashed #e2e8f0;
    font-weight: 600;
    color: #1e293b;
}

.total-value {
    font-size: 24px;
    color: #22c55e;
}

/* Status Section */
.status-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: #f1f5f9;
    border-radius: 12px;
}

.status-label {
    font-weight: 600;
    color: #64748b;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    border-radius: 25px;
    font-size: 13px;
    font-weight: 600;
}

.status-badge.pending {
    background: #fef3c7;
    color: #b45309;
}

.status-badge.verified {
    background: #d1fae5;
    color: #059669;
}

.status-badge.rejected {
    background: #fee2e2;
    color: #dc2626;
}

/* Card Footer */
.card-footer-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.footer-actions {
    display: flex;
    gap: 10px;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #e2e8f0;
    color: #64748b;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-back:hover {
    background: #cbd5e1;
    color: #475569;
}

.btn-pay {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-pay:hover {
    transform: translateY(-2px);
    color: #fff;
}

.btn-print {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-print:hover {
    transform: translateY(-2px);
    color: #fff;
}

.btn-print-disabled {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #9ca3af;
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    cursor: not-allowed;
    opacity: 0.7;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .card-footer-custom {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-back {
        width: 100%;
        justify-content: center;
    }
    
    .footer-actions {
        width: 100%;
    }
    
    .footer-actions a {
        flex: 1;
        justify-content: center;
    }
}
</style>

@if($transaksi->kode_tiket)
<!-- QR Code Library -->
<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var qrcodeEl = document.getElementById('qrcode-detail');
    if (qrcodeEl) {
        try {
            // Hapus teks loading
            var loadingText = qrcodeEl.querySelector('.loading-text');
            
            new QRCode(qrcodeEl, {
                text: "{{ config('app.url') }}/tiket/scan/{{ $transaksi->kode_tiket }}",
                width: 160,
                height: 160,
                colorDark: "#0f172a",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
            
            if (loadingText) loadingText.remove();
            console.log("QR Code generated for: {{ $transaksi->kode_tiket }}");
        } catch (e) {
            console.error("Gagal generate QR Code:", e);
            qrcodeEl.innerHTML = '<span class="text-danger small">Gagal memuat QR Code</span>';
        }
    }
});
</script>
@endif

@endsection
