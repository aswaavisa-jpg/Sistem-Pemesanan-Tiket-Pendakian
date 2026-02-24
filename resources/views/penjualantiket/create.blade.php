@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="tiket-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-credit-card-2-front"></i>
        </div>
        <h2 class="hero-title">Pembayaran Tiket</h2>
        <p class="hero-subtitle">Pilih pemesanan dan selesaikan pembayaran tiket pendakian</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Step Indicator Card -->
            <div class="step-card mb-4">
                <div class="step-indicator">
                    <div class="step completed">
                        <span class="step-number"><i class="bi bi-check"></i></span>
                        <span class="step-text">Pemesanan</span>
                    </div>
                    <div class="step-line completed"></div>
                    <div class="step completed">
                        <span class="step-number"><i class="bi bi-check"></i></span>
                        <span class="step-text">Data Pendaki</span>
                    </div>
                    <div class="step-line completed"></div>
                    <div class="step active">
                        <span class="step-number">3</span>
                        <span class="step-text">Pembayaran</span>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="tiket-card">
                <div class="card-header-custom">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Buat Tiket Pendakian</span>
                </div>

                <div class="card-body-custom">
                    @if ($errors->any())
                        <div class="alert-custom alert-danger">
                            <div class="alert-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content">
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('penjualantiket.store') }}" method="POST">
                        @csrf

                        <!-- Pilih Pemesanan -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Pilih Pemesanan <span class="required">*</span>
                            </label>
                            <div class="select-wrapper">
                                <select name="pemesanan_id" 
                                        id="pemesananSelect"
                                        class="form-control-custom @error('pemesanan_id') is-invalid @enderror" 
                                        required>
                                    <option value="">-- Pilih Pemesanan --</option>
                                    @foreach ($pemesanan as $p)
                                        <option value="{{ $p->id }}" 
                                                data-jumlah="{{ $p->jumlah_anggota }}"
                                                data-jalur="{{ $p->jalur_pendakian }}"
                                                data-naik="{{ \Carbon\Carbon::parse($p->tgl_naik)->format('d M Y') }}"
                                                data-turun="{{ \Carbon\Carbon::parse($p->tgl_turun)->format('d M Y') }}"
                                                {{ old('pemesanan_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->jalur_pendakian }} | {{ \Carbon\Carbon::parse($p->tgl_naik)->format('d M Y') }} - {{ \Carbon\Carbon::parse($p->tgl_turun)->format('d M Y') }} | {{ $p->jumlah_anggota }} orang
                                        </option>
                                    @endforeach
                                </select>
                                <div class="select-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            @error('pemesanan_id')
                                <div class="error-message">
                                    <i class="bi bi-x-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Info Pemesanan -->
                        <div class="info-card d-none" id="infoCard">
                            <div class="info-card-header">
                                <i class="bi bi-receipt"></i>
                                <span>Rincian Pemesanan</span>
                            </div>
                            <div class="info-card-body">
                                <div class="info-row">
                                    <div class="info-item">
                                        <span class="info-label">Jalur Pendakian</span>
                                        <span class="info-value" id="infoJalur">-</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Tanggal Pendakian</span>
                                        <span class="info-value" id="infoTanggal">-</span>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <div class="info-item">
                                        <span class="info-label">Jumlah Pendaki</span>
                                        <span class="info-value" id="infoJumlah">-</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Harga per Orang</span>
                                        <span class="info-value">Rp 20.000</span>
                                    </div>
                                </div>
                                <div class="total-section">
                                    <span class="total-label">Total Pembayaran</span>
                                    <span class="total-value" id="infoTotal">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('penjualantiket.index') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-credit-card"></i> Buat Tiket
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="payment-info mt-4">
                <div class="payment-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Pembayaran Aman</span>
                </div>
                <div class="payment-item">
                    <i class="bi bi-clock-history"></i>
                    <span>Proses Cepat</span>
                </div>
                <div class="payment-item">
                    <i class="bi bi-printer"></i>
                    <span>E-Tiket Langsung</span>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Hero Section */
.tiket-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.tiket-hero::before {
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

/* Step Card */
.step-card {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    border-radius: 16px;
    padding: 25px 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

.step-indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.step {
    display: flex;
    align-items: center;
    gap: 8px;
    opacity: 0.5;
    transition: all 0.3s;
}

.step.active, .step.completed {
    opacity: 1;
}

.step-number {
    width: 32px;
    height: 32px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
}

.step.active .step-number {
    background: linear-gradient(135deg, #facc15, #f59e0b);
    color: #0f172a;
}

.step.completed .step-number {
    background: #22c55e;
    color: #fff;
}

.step-text {
    color: #fff;
    font-size: 13px;
    font-weight: 500;
}

.step-line {
    width: 40px;
    height: 2px;
    background: rgba(255,255,255,0.2);
}

.step-line.completed {
    background: #22c55e;
}

/* Tiket Card */
.tiket-card {
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
    padding: 35px 30px;
}

/* Alert Custom */
.alert-custom {
    display: flex;
    gap: 15px;
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 25px;
}

.alert-danger {
    background: #fef2f2;
    border: 1px solid #fecaca;
}

.alert-icon {
    font-size: 24px;
    flex-shrink: 0;
    color: #dc2626;
}

/* Form Groups */
.form-group-custom {
    margin-bottom: 25px;
}

.form-label-custom {
    display: block;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
    font-size: 15px;
}

.required {
    color: #dc2626;
}

/* Select Wrapper */
.select-wrapper {
    position: relative;
}

.form-control-custom {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 15px;
    color: #1e293b;
    background: #f8fafc;
    transition: all 0.3s;
    appearance: none;
    padding-right: 45px;
}

.form-control-custom:focus {
    outline: none;
    border-color: #3b82f6;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.select-arrow {
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    pointer-events: none;
}

.error-message {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #dc2626;
    font-size: 13px;
    margin-top: 8px;
}

/* Info Card */
.info-card {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 25px;
}

.info-card-header {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    padding: 12px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
}

.info-card-body {
    padding: 20px;
}

.info-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 15px;
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

.total-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
    border-top: 2px dashed #e2e8f0;
    margin-top: 10px;
}

.total-label {
    font-weight: 600;
    color: #64748b;
}

.total-value {
    font-size: 24px;
    font-weight: 700;
    color: #22c55e;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e2e8f0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 24px;
    background: #f1f5f9;
    color: #64748b;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.btn-back:hover {
    background: #e2e8f0;
    color: #475569;
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
}

/* Payment Info */
.payment-info {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
}

.payment-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
    font-size: 13px;
}

.payment-item i {
    color: #22c55e;
    font-size: 16px;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .step-text {
        display: none;
    }
    
    .card-body-custom {
        padding: 25px 20px;
    }
    
    .info-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .action-buttons {
        flex-direction: column-reverse;
        gap: 15px;
    }
    
    .btn-back, .btn-submit {
        width: 100%;
        justify-content: center;
    }
    
    .payment-info {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
}
</style>

<script>
document.getElementById('pemesananSelect').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const infoCard = document.getElementById('infoCard');
    
    if (this.value) {
        const jumlah = selected.dataset.jumlah;
        const jalur = selected.dataset.jalur;
        const naik = selected.dataset.naik;
        const turun = selected.dataset.turun;
        const total = jumlah * 20000;
        
        document.getElementById('infoJalur').textContent = jalur;
        document.getElementById('infoTanggal').textContent = naik + ' - ' + turun;
        document.getElementById('infoJumlah').textContent = jumlah + ' orang';
        document.getElementById('infoTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
        
        infoCard.classList.remove('d-none');
    } else {
        infoCard.classList.add('d-none');
    }
});

// Trigger on page load if already selected
window.addEventListener('load', function() {
    const select = document.getElementById('pemesananSelect');
    if (select.value) {
        select.dispatchEvent(new Event('change'));
    }
});
</script>

@endsection
