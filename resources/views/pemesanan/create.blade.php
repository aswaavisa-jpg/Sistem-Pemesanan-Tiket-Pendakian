@extends('layout')

@section('content')

<!-- Hero Section with Mountain Background -->
<div class="booking-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-ticket-perforated"></i>
        </div>
        <h2 class="hero-title">Pemesanan Tiket Pendakian</h2>
        <p class="hero-subtitle">Gunung Merbabu</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            <!-- Info Card -->
            <div class="info-banner mb-4">
                <div class="info-icon">
                    <i class="bi bi-info-circle"></i>
                </div>
                <div class="info-text">
                    <strong>Perhatian!</strong> Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan ke pendaftaran anggota.
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="booking-card">
                <div class="card-header-custom">
                    <div class="step-indicator">
                        <div class="step active">
                            <span class="step-number">1</span>
                            <span class="step-text">Pemesanan</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step">
                            <span class="step-number">2</span>
                            <span class="step-text">Data Pendaki</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step">
                            <span class="step-number">3</span>
                            <span class="step-text">Pembayaran</span>
                        </div>
                    </div>
                </div>

                <div class="card-body-custom">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-custom">
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

                    <form action="{{ route('pemesanan.store') }}" method="POST" id="bookingForm">
                        @csrf

                        <!-- Jalur Pendakian -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                <i class="bi bi-signpost-split"></i> Jalur Pendakian
                            </label>
                            <div class="select-wrapper">
                                <select name="jalur_pendakian" class="form-control-custom @error('jalur_pendakian') is-invalid @enderror" required>
                                    <option value="">-- Pilih Jalur Pendakian --</option>
                                    <option value="Selo" {{ old('jalur_pendakian') == 'Selo' ? 'selected' : '' }}>
                                        Selo (Boyolali)
                                    </option>
                                    <option value="Wekas" {{ old('jalur_pendakian') == 'Wekas' ? 'selected' : '' }}>
                                        Wekas (Magelang)
                                    </option>
                                    <option value="Thekelan" {{ old('jalur_pendakian') == 'Thekelan' ? 'selected' : '' }}>
                                        Thekelan (Boyolali)
                                    </option>
                                    <option value="Cunthel" {{ old('jalur_pendakian') == 'Cunthel' ? 'selected' : '' }}>
                                        Cunthel (Semarang)
                                    </option>
                                    <option value="Suwanting" {{ old('jalur_pendakian') == 'Suwanting' ? 'selected' : '' }}>
                                        Suwanting (Magelang)
                                    </option>
                                </select>
                                <div class="select-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            @error('jalur_pendakian')
                                <div class="error-message">
                                    <i class="bi bi-x-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tanggal Section -->
                        <div class="date-section">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="bi bi-calendar-plus"></i> Tanggal Naik
                                        </label>
                                        <div class="date-input-wrapper">
                                            <input type="date" 
                                                   name="tgl_naik" 
                                                   class="form-control-custom date-input @error('tgl_naik') is-invalid @enderror" 
                                                   value="{{ old('tgl_naik') }}" 
                                                   min="{{ date('Y-m-d') }}"
                                                   required>

                                        </div>
                                        @error('tgl_naik')
                                            <div class="error-message">
                                                <i class="bi bi-x-circle"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="bi bi-calendar-minus"></i> Tanggal Turun
                                        </label>
                                        <div class="date-input-wrapper">
                                            <input type="date" 
                                                   name="tgl_turun" 
                                                   class="form-control-custom date-input @error('tgl_turun') is-invalid @enderror" 
                                                   value="{{ old('tgl_turun') }}" 
                                                   min="{{ date('Y-m-d') }}"
                                                   required>

                                        </div>
                                        @error('tgl_turun')
                                            <div class="error-message">
                                                <i class="bi bi-x-circle"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('dashboard') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn-submit">
                                Lanjutkan <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            

<style>
/* Hero Section */
.booking-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.booking-hero::before {
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

/* Info Banner */
.info-banner {
    display: flex;
    align-items: center;
    gap: 15px;
    background: linear-gradient(135deg, #dbeafe, #eff6ff);
    border: 1px solid #93c5fd;
    border-radius: 12px;
    padding: 16px 20px;
    color: #1e40af;
}

.info-icon {
    font-size: 24px;
    flex-shrink: 0;
}

.info-text {
    font-size: 14px;
    line-height: 1.5;
}

/* Booking Card */
.booking-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header-custom {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    padding: 25px 30px;
}

/* Step Indicator */
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

.step.active {
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
    border: none;
}

.alert-icon {
    font-size: 24px;
    flex-shrink: 0;
}

/* Form Groups */
.form-group-custom {
    margin-bottom: 25px;
}

.form-label-custom {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
    font-size: 15px;
}

.form-label-custom i {
    color: #3b82f6;
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

/* Date Input */
.date-section {
    background: #f8fafc;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 25px;
    border: 1px solid #e2e8f0;
}

.date-input-wrapper {
    position: relative;
}

.date-input {
    padding-right: 50px;
}

.date-icon {
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #3b82f6;
    font-size: 18px;
}

/* Number Input */
.number-input-wrapper {
    display: flex;
    align-items: center;
    gap: 10px;
    max-width: 200px;
}

.number-btn {
    width: 48px;
    height: 48px;
    border: 2px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s;
}

.number-btn:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    background: #eff6ff;
}

.number-input {
    width: 80px;
    text-align: center;
    padding: 12px;
    font-size: 18px;
    font-weight: 600;
}

.form-hint {
    display: block;
    margin-top: 8px;
    color: #64748b;
    font-size: 13px;
}

/* Error Message */
.error-message {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #dc2626;
    font-size: 13px;
    margin-top: 8px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 35px;
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
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

/* Additional Info */
.additional-info {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 30px;
    padding: 20px;
    flex-wrap: wrap;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
    font-size: 13px;
}

.info-item i {
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
    
    .action-buttons {
        flex-direction: column-reverse;
        gap: 15px;
    }
    
    .btn-back, .btn-submit {
        width: 100%;
        justify-content: center;
    }
    
    .additional-info {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }
}
</style>

<script>
// Date validation
document.addEventListener('DOMContentLoaded', function() {
    const tglNaik = document.querySelector('input[name="tgl_naik"]');
    const tglTurun = document.querySelector('input[name="tgl_turun"]');
    
    tglNaik.addEventListener('change', function() {
        tglTurun.setAttribute('min', this.value);
        if (tglTurun.value && tglTurun.value < this.value) {
            tglTurun.value = this.value;
        }
    });
});
</script>

@endsection
