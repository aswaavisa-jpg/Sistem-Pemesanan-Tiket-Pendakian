@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="pendaki-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <h2 class="hero-title">Data Anggota Pendaki</h2>
        <p class="hero-subtitle">Lengkapi data {{ $sisaAnggota }} anggota pendaki untuk pemesanan ini</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <!-- Step Indicator Card -->
            <div class="step-card mb-4">
                <div class="step-indicator">
                    <div class="step completed">
                        <span class="step-number"><i class="bi bi-check"></i></span>
                        <span class="step-text">Pemesanan</span>
                    </div>
                    <div class="step-line completed"></div>
                    <div class="step active">
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

            <!-- Info Pemesanan Card -->
            <div class="info-pemesanan-card mb-4">
                <div class="info-header">
                    <i class="bi bi-clipboard-check"></i>
                    <span>Informasi Pemesanan</span>
                </div>
                <div class="info-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon-small">
                                <i class="bi bi-signpost-split"></i>
                            </div>
                            <div class="info-detail">
                                <span class="info-label">Jalur Pendakian</span>
                                <span class="info-value">{{ $pemesanan->jalur_pendakian }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon-small">
                                <i class="bi bi-calendar-range"></i>
                            </div>
                            <div class="info-detail">
                                <span class="info-label">Tanggal Pendakian</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($pemesanan->tgl_naik)->format('d M Y') }} - 
                                    {{ \Carbon\Carbon::parse($pemesanan->tgl_turun)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon-small">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="info-detail">
                                <span class="info-label">Progress Pendaftaran</span>
                                <span class="info-value">
                                    <span class="progress-badge">{{ $existingCount }}/{{ $jumlahAnggota }}</span> anggota terdaftar
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="form-card">
                <div class="form-card-header">
                    <i class="bi bi-person-vcard"></i>
                    <span>Form Data Pendaki</span>
                </div>

                <div class="form-card-body">
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

                    @if(session('success'))
                        <div class="alert-custom alert-success">
                            <div class="alert-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="alert-content">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('detailpendaki.store') }}" method="POST" id="formPendaki" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">

                        <!-- Pendaki Forms -->
                        <div id="pendakiContainer">
                            @for ($i = 0; $i < $sisaAnggota; $i++)
                            <div class="pendaki-section" data-index="{{ $i }}">
                                <div class="pendaki-header">
                                    <div class="pendaki-title">
                                        <div class="pendaki-avatar">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <span>Pendaki {{ $existingCount + $i + 1 }}</span>
                                    </div>
                                    <span class="pendaki-badge">Anggota ke-{{ $existingCount + $i + 1 }} dari {{ $jumlahAnggota }}</span>
                                </div>

                                <div class="pendaki-body">
                                    <!-- NIK & Nama -->
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom">
                                                    NIK <span class="required">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="pendaki[{{ $i }}][nik]" 
                                                       class="form-control-custom nik-input" 
                                                       data-index="{{ $i }}"
                                                       maxlength="16"
                                                       pattern="[0-9]{16}"
                                                       placeholder="Masukkan 16 digit NIK"
                                                       value="{{ old('pendaki.' . $i . '.nik') }}"
                                                       required>
                                                <div class="nik-status" id="nikStatus{{ $i }}"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom">
                                                    Nama Lengkap <span class="required">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="pendaki[{{ $i }}][nama]" 
                                                       id="nama{{ $i }}"
                                                       class="form-control-custom" 
                                                       placeholder="Nama lengkap sesuai KTP"
                                                       value="{{ old('pendaki.' . $i . '.nama') }}"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin, Tanggal Lahir, No HP -->
                                    <div class="row g-4">
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom">
                                                    Jenis Kelamin <span class="required">*</span>
                                                </label>
                                                <div class="select-wrapper">
                                                    <select name="pendaki[{{ $i }}][jenis_kelamin]" id="jenis_kelamin{{ $i }}" class="form-control-custom" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Laki-laki" {{ old('pendaki.' . $i . '.jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="Perempuan" {{ old('pendaki.' . $i . '.jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    </select>
                                                    <div class="select-arrow">
                                                        <i class="bi bi-chevron-down"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom">
                                                    Tanggal Lahir <span class="required">*</span>
                                                </label>
                                                <input type="date" 
                                                       name="pendaki[{{ $i }}][tanggal_lahir]" 
                                                       id="tanggal_lahir{{ $i }}"
                                                       class="form-control-custom"
                                                       value="{{ old('pendaki.' . $i . '.tanggal_lahir') }}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom">
                                                    No HP <span class="required">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="pendaki[{{ $i }}][no_hp]" 
                                                       id="no_hp{{ $i }}"
                                                       class="form-control-custom" 
                                                       placeholder="08xxxxxxxxxx"
                                                       value="{{ old('pendaki.' . $i . '.no_hp') }}"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- No HP Darurat -->
                                    <div class="row g-4 mt-1">
                                        <div class="col-md-6">
                                            <div class="form-group-custom">
                                                <label class="form-label-custom">
                                                    <i class="bi bi-telephone-fill" style="color: #dc2626;"></i>
                                                    No HP Darurat <span class="required">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="pendaki[{{ $i }}][no_hp_darurat]" 
                                                       id="no_hp_darurat{{ $i }}"
                                                       class="form-control-custom" 
                                                       placeholder="Nomor kontak darurat"
                                                       value="{{ old('pendaki.' . $i . '.no_hp_darurat') }}"
                                                       required>
                                                <small class="form-hint-red">Nomor keluarga/kerabat yang bisa dihubungi saat darurat</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Alamat Section -->
                                    <div class="alamat-section">
                                        <div class="alamat-header">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            <span>Alamat Lengkap</span>
                                        </div>

                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">RT/RW</label>
                                                    <input type="text" 
                                                           name="pendaki[{{ $i }}][rt_rw]" 
                                                           id="rt_rw{{ $i }}"
                                                           class="form-control-custom" 
                                                           placeholder="Contoh: 01/02"
                                                           value="{{ old('pendaki.' . $i . '.rt_rw') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">Dusun</label>
                                                    <input type="text" 
                                                           name="pendaki[{{ $i }}][dusun]" 
                                                           id="dusun{{ $i }}"
                                                           class="form-control-custom" 
                                                           placeholder="Nama Dusun"
                                                           value="{{ old('pendaki.' . $i . '.dusun') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">Desa/Kelurahan</label>
                                                    <input type="text" 
                                                           name="pendaki[{{ $i }}][desa]" 
                                                           id="desa{{ $i }}"
                                                           class="form-control-custom" 
                                                           placeholder="Nama Desa"
                                                           value="{{ old('pendaki.' . $i . '.desa') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-4">
                                            <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">Kecamatan</label>
                                                    <input type="text" 
                                                           name="pendaki[{{ $i }}][kecamatan]" 
                                                           id="kecamatan{{ $i }}"
                                                           class="form-control-custom" 
                                                           placeholder="Nama Kecamatan"
                                                           value="{{ old('pendaki.' . $i . '.kecamatan') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">Kabupaten/Kota</label>
                                                    <input type="text" 
                                                           name="pendaki[{{ $i }}][kabupaten]" 
                                                           id="kabupaten{{ $i }}"
                                                           class="form-control-custom" 
                                                           placeholder="Nama Kabupaten"
                                                           value="{{ old('pendaki.' . $i . '.kabupaten') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">Provinsi</label>
                                                    <input type="text" 
                                                           name="pendaki[{{ $i }}][provinsi]" 
                                                           id="provinsi{{ $i }}"
                                                           class="form-control-custom" 
                                                           placeholder="Nama Provinsi"
                                                           value="{{ old('pendaki.' . $i . '.provinsi') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Dokumen Pendukung -->
                                    <div class="dokumen-section">
                                        <div class="dokumen-header">
                                            <i class="bi bi-camera-fill"></i>
                                            <span>Dokumen Pendukung</span>
                                        </div>

                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">
                                                        <i class="bi bi-credit-card-2-front"></i>
                                                        Foto KTP <span class="required">*</span>
                                                    </label>
                                                    <div class="upload-area" id="uploadKtp{{ $i }}" onclick="document.getElementById('fotoKtp{{ $i }}').click()">
                                                        <input type="file" 
                                                               name="pendaki_foto_ktp_{{ $i }}" 
                                                               id="fotoKtp{{ $i }}"
                                                               class="file-input-hidden" 
                                                               accept="image/jpeg,image/png,image/jpg"
                                                               onchange="previewImage(this, 'previewKtp{{ $i }}', 'uploadKtp{{ $i }}')"
                                                               required>
                                                        <div class="upload-placeholder" id="placeholderKtp{{ $i }}">
                                                            <i class="bi bi-credit-card-2-front"></i>
                                                            <span>Klik untuk upload foto KTP</span>
                                                            <small>JPG, JPEG, PNG (maks. 2MB)</small>
                                                        </div>
                                                        <img id="previewKtp{{ $i }}" class="upload-preview" style="display:none;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group-custom">
                                                    <label class="form-label-custom">
                                                        <i class="bi bi-person-bounding-box"></i>
                                                        Foto Selfie <span class="required">*</span>
                                                    </label>
                                                    <div class="upload-area" id="uploadSelfie{{ $i }}" onclick="document.getElementById('fotoSelfie{{ $i }}').click()">
                                                        <input type="file" 
                                                               name="pendaki_foto_selfie_{{ $i }}" 
                                                               id="fotoSelfie{{ $i }}"
                                                               class="file-input-hidden" 
                                                               accept="image/jpeg,image/png,image/jpg"
                                                               onchange="previewImage(this, 'previewSelfie{{ $i }}', 'uploadSelfie{{ $i }}')"
                                                               required>
                                                        <div class="upload-placeholder" id="placeholderSelfie{{ $i }}">
                                                            <i class="bi bi-person-bounding-box"></i>
                                                            <span>Klik untuk upload foto selfie</span>
                                                            <small>JPG, JPEG, PNG (maks. 2MB)</small>
                                                        </div>
                                                        <img id="previewSelfie{{ $i }}" class="upload-preview" style="display:none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('pemesanan.index') }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-save"></i> Simpan Semua Pendaki
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Hero Section */
.pendaki-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.pendaki-hero::before {
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

/* Info Pemesanan Card */
.info-pemesanan-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

.info-header {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    padding: 15px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-body {
    padding: 20px;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.info-icon-small {
    width: 40px;
    height: 40px;
    background: #eff6ff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #3b82f6;
    font-size: 18px;
    flex-shrink: 0;
}

.info-detail {
    display: flex;
    flex-direction: column;
}

.info-label {
    font-size: 12px;
    color: #64748b;
    margin-bottom: 4px;
}

.info-value {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.progress-badge {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 12px;
}

/* Form Card */
.form-card {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 50px rgba(0,0,0,0.1);
    overflow: hidden;
}

.form-card-header {
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    color: #fff;
    padding: 20px 25px;
    font-weight: 600;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-card-body {
    padding: 30px;
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

.alert-success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
}

.alert-icon {
    font-size: 24px;
    flex-shrink: 0;
}

.alert-danger .alert-icon {
    color: #dc2626;
}

.alert-success .alert-icon {
    color: #22c55e;
}

/* Pendaki Section */
.pendaki-section {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 16px;
    margin-bottom: 25px;
    overflow: hidden;
    transition: all 0.3s;
}

.pendaki-section:hover {
    border-color: #3b82f6;
    box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
}

.pendaki-header {
    background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
    padding: 18px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e2e8f0;
}

.pendaki-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    color: #1e293b;
    font-size: 15px;
}

.pendaki-avatar {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 16px;
}

.pendaki-badge {
    background: #e2e8f0;
    color: #64748b;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
}

.pendaki-body {
    padding: 25px;
}

/* Alamat Section */
.alamat-section {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
}

.dokumen-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #3b82f6;
    margin-bottom: 20px;
    font-size: 14px;
}

/* Upload Area */
.upload-area {
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s;
    background: #f8fafc;
    position: relative;
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.upload-area:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.file-input-hidden {
    display: none;
}

.upload-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: #64748b;
}

.upload-placeholder i {
    font-size: 32px;
    color: #94a3b8;
}

.upload-placeholder span {
    font-size: 14px;
    font-weight: 500;
}

.upload-placeholder small {
    font-size: 12px;
    color: #94a3b8;
}

.upload-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

.upload-area.has-image .upload-placeholder {
    display: none;
}

.form-hint-red {
    display: block;
    margin-top: 5px;
    color: #ef4444;
    font-size: 12px;
}

.alamat-header {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #3b82f6;
    margin-bottom: 20px;
    font-size: 14px;
}

/* Form Groups */
.form-group-custom {
    margin-bottom: 0;
}

.form-label-custom {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 10px;
    font-size: 14px;
}

.form-label-custom i {
    color: #3b82f6;
}

.required {
    color: #dc2626;
}

.form-control-custom {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    color: #1e293b;
    background: #fff;
    transition: all 0.3s;
    appearance: none;
}

.form-control-custom:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
}

.form-control-custom::placeholder {
    color: #94a3b8;
}

/* Select Wrapper */
.select-wrapper {
    position: relative;
}

.select-arrow {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    pointer-events: none;
}

/* NIK Status */
.nik-status {
    font-size: 12px;
    margin-top: 8px;
    padding: 6px 10px;
    border-radius: 6px;
}

    .nik-status:empty {
        display: none;
    }


.nik-found {
    background: #f0fdf4;
    color: #15803d;
    border: 1px solid #bbf7d0;
}

.nik-new {
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
}

.nik-warning {
    background: #fffbeb;
    color: #b45309;
    border: 1px solid #fde68a;
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

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .step-text {
        display: none;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .form-card-body {
        padding: 20px;
    }
    
    .pendaki-header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .action-buttons {
        flex-direction: column-reverse;
        gap: 15px;
    }
    
    .btn-back, .btn-submit {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nikInputs = document.querySelectorAll('.nik-input');
    
    nikInputs.forEach(input => {
        input.addEventListener('blur', function() {
            const nik = this.value.trim();
            const index = this.dataset.index;
            const statusDiv = document.getElementById(`nikStatus${index}`);
            
            if (nik.length === 16) {
                fetch(`{{ url('pendaki/check-nik') }}?nik=${nik}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            statusDiv.innerHTML = '<i class="bi bi-check-circle"></i> NIK ditemukan: <strong>' + data.pendaki.nama + '</strong>';
                            statusDiv.className = 'nik-status nik-found';
                            
                            // Auto-fill fields
                            document.getElementById(`nama${index}`).value = data.pendaki.nama;
                            document.getElementById(`jenis_kelamin${index}`).value = data.pendaki.jenis_kelamin;
                            document.getElementById(`tanggal_lahir${index}`).value = data.pendaki.tanggal_lahir;
                            document.getElementById(`no_hp${index}`).value = data.pendaki.no_hp || '';
                            document.getElementById(`rt_rw${index}`).value = data.pendaki.rt_rw || '';
                            document.getElementById(`dusun${index}`).value = data.pendaki.dusun || '';
                            document.getElementById(`desa${index}`).value = data.pendaki.desa || '';
                            document.getElementById(`kecamatan${index}`).value = data.pendaki.kecamatan || '';
                            document.getElementById(`kabupaten${index}`).value = data.pendaki.kabupaten || '';
                            document.getElementById(`provinsi${index}`).value = data.pendaki.provinsi || '';
                        } else {
                            statusDiv.innerHTML = '<i class="bi bi-plus-circle"></i> NIK baru, silakan lengkapi data';
                            statusDiv.className = 'nik-status nik-new';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        statusDiv.innerHTML = '';
                    });
            } else if (nik.length > 0 && nik.length < 16) {
                statusDiv.innerHTML = '<i class="bi bi-exclamation-circle"></i> NIK harus 16 digit';
                statusDiv.className = 'nik-status nik-warning';
            } else {
                statusDiv.innerHTML = '';
            }
        });

        // Only allow numbers
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
});
</script>

<script>
function previewImage(input, previewId, areaId) {
    const preview = document.getElementById(previewId);
    const area = document.getElementById(areaId);
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            area.classList.add('has-image');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
