@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="pemesanan-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-card-list"></i>
        </div>
        <h2 class="hero-title">Daftar Pemesanan</h2>
        <p class="hero-subtitle">Kelola pemesanan tiket pendakian Anda</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Header Card -->
            <div class="header-card mb-4">
                <div class="header-info">
                    <h5 class="header-title">
                        <i class="bi bi-plus-circle"></i> Buat Pemesanan Baru
                    </h5>
                </div>
            </div>

            <!-- Form Card -->
            @auth
            <div class="form-card">
                <div class="card-header-custom">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Form Pemesanan</span>
                </div>

                <div class="card-body-custom">
                    <form action="{{ route('pemesanan.store') }}" method="POST">
                        @csrf

                        <!-- Jalur Pendakian -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Jalur Pendakian <span class="required">*</span>
                            </label>
                            <div class="select-wrapper">
                                <select name="jalur_id" class="form-control-custom" required>
                                    <option value="">-- Pilih Jalur --</option>
                                    @foreach ($jalur as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_gunung }}</option>
                                    @endforeach
                                </select>
                                <div class="select-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal -->
                        <div class="date-section">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            Tanggal Naik <span class="required">*</span>
                                        </label>
                                        <input type="date" name="tanggal_naik" class="form-control-custom" min="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            Tanggal Turun <span class="required">*</span>
                                        </label>
                                        <input type="date" name="tanggal_turun" class="form-control-custom" min="{{ date('Y-m-d') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Anggota -->
                        <div class="form-group-custom">
                            <label class="form-label-custom">
                                Jumlah Anggota <span class="required">*</span>
                            </label>
                            <div class="number-input-wrapper">
                                <button type="button" class="number-btn minus" onclick="decrementValue()">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" name="jumlah_anggota" id="jumlahAnggota" class="form-control-custom number-input" min="1" max="10" value="1" required>
                                <button type="button" class="number-btn plus" onclick="incrementValue()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <small class="form-hint">Minimal 1 orang, maksimal 10 orang per rombongan</small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('detailpendaki.create') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endauth

            @guest
            <div class="form-card text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-lock-fill text-muted" style="font-size: 3rem;"></i>
                </div>
                <h3>Lakukan Login Terlebih Dahulu</h3>
                <p class="text-muted mb-4">Anda perlu login atau mendaftar untuk melakukan pemesanan tiket pendakian.</p>
                
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2" style="border-radius: 12px;">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary px-4 py-2" style="border-radius: 12px;">
                        <i class="bi bi-person-plus me-2"></i> Daftar
                    </a>
                </div>
            </div>
            @endguest

        </div>
    </div>
</div>

<style>
/* Hero Section */
.pemesanan-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.pemesanan-hero::before {
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

.hero-title { color: #fff; font-size: 2.5rem; font-weight: 700; margin-bottom: 10px; }
.hero-subtitle { color: #94a3b8; font-size: 1.1rem; margin: 0; }

/* Header Card */
.header-card { background: #fff; padding: 20px 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
.header-title { font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; }

/* Form Card */
.form-card { background: #fff; border-radius: 20px; box-shadow: 0 10px 50px rgba(0,0,0,0.1); overflow: hidden; }
.card-header-custom { background: linear-gradient(135deg, #0f172a, #1e3a5f); color: #fff; padding: 20px 25px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
.card-body-custom { padding: 35px 30px; }

/* Form Groups */
.form-group-custom { margin-bottom: 25px; }
.form-label-custom { display: block; font-weight: 600; color: #1e293b; margin-bottom: 10px; font-size: 15px; }
.required { color: #dc2626; }

/* Select */
.select-wrapper { position: relative; }
.form-control-custom { width: 100%; padding: 14px 18px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 15px; color: #1e293b; background: #f8fafc; transition: all 0.3s; appearance: none; }
.form-control-custom:focus { outline: none; border-color: #3b82f6; background: #fff; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }
.select-arrow { position: absolute; right: 18px; top: 50%; transform: translateY(-50%); color: #64748b; pointer-events: none; }

/* Date Section */
.date-section { background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e2e8f0; }

/* Number Input */
.number-input-wrapper { display: flex; align-items: center; gap: 10px; max-width: 200px; }
.number-btn { width: 48px; height: 48px; border: 2px solid #e2e8f0; background: #f8fafc; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #64748b; cursor: pointer; transition: all 0.3s; }
.number-btn:hover { border-color: #3b82f6; color: #3b82f6; background: #eff6ff; }
.number-input { width: 80px; text-align: center; padding: 12px; font-size: 18px; font-weight: 600; }
.form-hint { display: block; margin-top: 8px; color: #64748b; font-size: 13px; }

/* Action Buttons */
.action-buttons { display: flex; justify-content: space-between; align-items: center; margin-top: 35px; padding-top: 25px; border-top: 1px solid #e2e8f0; }
.btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 14px 24px; background: #f1f5f9; color: #64748b; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
.btn-back:hover { background: #e2e8f0; color: #475569; }
.btn-submit { display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3); }
.btn-submit:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4); }

@media (max-width: 768px) {
    .hero-title { font-size: 1.8rem; }
    .card-body-custom { padding: 25px 20px; }
    .action-buttons { flex-direction: column-reverse; gap: 15px; }
    .btn-back, .btn-submit { width: 100%; justify-content: center; }
}
</style>

<script>
function incrementValue() {
    const input = document.getElementById('jumlahAnggota');
    const max = parseInt(input.getAttribute('max'));
    let value = parseInt(input.value) || 1;
    if (value < max) input.value = value + 1;
}

function decrementValue() {
    const input = document.getElementById('jumlahAnggota');
    const min = parseInt(input.getAttribute('min'));
    let value = parseInt(input.value) || 1;
    if (value > min) input.value = value - 1;
}
</script>

@endsection
