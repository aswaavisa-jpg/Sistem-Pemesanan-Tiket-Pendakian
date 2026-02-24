@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="transaksi-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-receipt-cutoff"></i>
        </div>
        <h2 class="hero-title">Daftar Transaksi Tiket</h2>
        <p class="hero-subtitle">Kelola semua transaksi pemesanan tiket pendakian</p>
    </div>
</div>

<div class="container my-5">
    <!-- Header Actions -->
    <div class="header-actions mb-4">
        <div class="header-info">
            <h5 class="header-title">
                <i class="bi bi-list-check"></i> Transaksi Saya
            </h5>
            <p class="header-subtitle">Total: {{ $penjualantiket->count() }} transaksi</p>
        </div>
        <a href="{{ route('pemesanan.create') }}" class="btn-add">
            <i class="bi bi-plus-circle"></i> Buat Booking Baru
        </a>
    </div>

    <!-- Transaction Cards -->
    @if($penjualantiket->isNotEmpty())
        <div class="transaction-list">
            @foreach($penjualantiket as $item)
            <div class="transaction-card">
                <div class="transaction-header">
                    <div class="transaction-code">
                        <span class="code-label">Kode Tiket</span>
                        <span class="code-value">{{ $item->kode_tiket }}</span>
                    </div>
                    <div class="transaction-status">
                        @if($item->isPending())
                            <span class="status-badge pending">
                                <i class="bi bi-clock"></i> Pending
                            </span>
                        @elseif($item->isVerified())
                            <span class="status-badge verified">
                                <i class="bi bi-check-circle"></i> Verified
                            </span>
                        @else
                            <span class="status-badge rejected">
                                <i class="bi bi-x-circle"></i> Rejected
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="transaction-body">
                    <div class="transaction-info">
                        <div class="info-item">
                            <i class="bi bi-signpost-2"></i>
                            <div class="info-content">
                                <span class="info-label">Jalur Pendakian</span>
                                <span class="info-value">{{ $item->nama_pendaki }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-calendar-event"></i>
                            <div class="info-content">
                                <span class="info-label">Tanggal Pendakian</span>
                                <span class="info-value">{{ \Carbon\Carbon::parse($item->tanggal_pendakian)->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-ticket-perforated"></i>
                            <div class="info-content">
                                <span class="info-label">Jumlah Tiket</span>
                                <span class="info-value">{{ $item->jumlah_tiket }} tiket</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="transaction-price">
                        <span class="price-label">Total Harga</span>
                        <span class="price-value">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="transaction-actions">
                    <a href="{{ route('penjualantiket.show', $item->id) }}" class="btn-action btn-detail">
                        <i class="bi bi-eye"></i> Detail
                    </a>
                    @if($item->isVerified())
                    <a href="{{ route('penjualantiket.print', $item->id) }}" class="btn-action btn-print">
                        <i class="bi bi-printer"></i> Cetak
                    </a>
                    @endif
                    @if($item->isPending())
                    <a href="{{ route('penjualantiket.editPayment', $item->id) }}" class="btn-action btn-pay">
                        <i class="bi bi-credit-card"></i> Bayar
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h5 class="empty-title">Belum Ada Transaksi</h5>
            <p class="empty-text">Anda belum memiliki transaksi tiket. Mulai dengan membuat transaksi baru.</p>
            <a href="{{ route('pemesanan.create') }}" class="btn-empty">
                <i class="bi bi-plus-circle"></i> Buat Booking Baru
            </a>
        </div>
    @endif
</div>

<style>
/* Hero Section */
.transaksi-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.transaksi-hero::before {
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

/* Header Actions */
.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
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

.btn-add {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
    color: #fff;
}

/* Transaction List */
.transaction-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Transaction Card */
.transaction-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: all 0.3s;
}

.transaction-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.transaction-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 25px;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-bottom: 1px solid #e2e8f0;
}

.transaction-code {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.code-label {
    font-size: 12px;
    color: #64748b;
}

.code-value {
    font-size: 18px;
    font-weight: 700;
    color: #1e293b;
}

/* Status Badge */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 20px;
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

/* Transaction Body */
.transaction-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
}

.transaction-info {
    display: flex;
    gap: 30px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.info-item > i {
    width: 36px;
    height: 36px;
    background: #eff6ff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3b82f6;
    font-size: 16px;
    flex-shrink: 0;
}

.info-content {
    display: flex;
    flex-direction: column;
    gap: 2px;
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

.transaction-price {
    text-align: right;
}

.price-label {
    display: block;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 4px;
}

.price-value {
    font-size: 24px;
    font-weight: 700;
    color: #22c55e;
}

/* Transaction Actions */
.transaction-actions {
    display: flex;
    gap: 10px;
    padding: 15px 25px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-detail {
    background: #eff6ff;
    color: #3b82f6;
}

.btn-detail:hover {
    background: #dbeafe;
    color: #1d4ed8;
}

.btn-print {
    background: #f0fdf4;
    color: #22c55e;
}

.btn-print:hover {
    background: #dcfce7;
    color: #16a34a;
}

.btn-pay {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
}

.btn-pay:hover {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #fff;
}

/* Empty State */
.empty-state {
    background: #fff;
    border-radius: 20px;
    padding: 60px 40px;
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
@media (max-width: 992px) {
    .transaction-body {
        flex-direction: column;
        align-items: flex-start;
        gap: 20px;
    }
    
    .transaction-info {
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .transaction-price {
        width: 100%;
        text-align: left;
        padding-top: 15px;
        border-top: 1px dashed #e2e8f0;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .transaction-info {
        flex-direction: column;
    }
    
    .transaction-actions {
        flex-wrap: wrap;
    }
    
    .btn-action {
        flex: 1;
        justify-content: center;
    }
}
</style>

@endsection
