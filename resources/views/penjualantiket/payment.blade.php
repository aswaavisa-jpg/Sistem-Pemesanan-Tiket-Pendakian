@extends('layout')

@section('content')

<!-- Hero Section -->
<div class="payment-hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-icon">
            <i class="bi bi-credit-card-2-front"></i>
        </div>
        <h2 class="hero-title">Verifikasi Pembayaran</h2>
        <p class="hero-subtitle">Kode Tiket: {{ $transaksi->kode_tiket }}</p>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <!-- Status Alert -->
            @if($transaksi->isVerified())
                <div class="status-alert status-verified mb-4">
                    <div class="status-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="status-content">
                        <strong>Pembayaran Terverifikasi!</strong>
                        <p>Pembayaran Anda telah dikonfirmasi oleh admin pada {{ $transaksi->verified_at->format('d M Y H:i') }}</p>
                        @if($transaksi->verifiedBy)
                            <small>Diverifikasi oleh: {{ $transaksi->verifiedBy->name }}</small>
                        @endif
                    </div>
                </div>
            @elseif($transaksi->isRejected())
                <div class="status-alert status-rejected mb-4">
                    <div class="status-icon">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                    <div class="status-content">
                        <strong>Pembayaran Ditolak</strong>
                        <p>Silakan upload ulang bukti pembayaran yang benar.</p>
                        @if($transaksi->catatan_verifikasi)
                            <small>Alasan: {{ str_replace('DITOLAK: ', '', $transaksi->catatan_verifikasi) }}</small>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Transaction Info Card -->
            <div class="info-card mb-4">
                <div class="card-header-custom">
                    <i class="bi bi-receipt"></i>
                    <span>Informasi Transaksi</span>
                </div>
                <div class="card-body-custom">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Kode Tiket</span>
                            <span class="info-value code">{{ $transaksi->kode_tiket }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Jalur Pendakian</span>
                            <span class="info-value">{{ $transaksi->nama_pendaki }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tanggal Pendakian</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_pendakian)->format('d M Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Jumlah Tiket</span>
                            <span class="info-value">{{ $transaksi->jumlah_tiket }} tiket</span>
                        </div>
                    </div>
                    <div class="total-section">
                        <span class="total-label">Total Pembayaran</span>
                        <span class="total-value">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Form (if not verified) -->
            @if(!$transaksi->isVerified())
            <div class="payment-card">
                <div class="card-header-custom payment-header">
                    <i class="bi bi-wallet2"></i>
                    <span>Kirim Bukti Pembayaran</span>
                </div>
                <div class="card-body-custom">
                    @if($errors->any())
                        <div class="alert-custom alert-danger mb-4">
                            <div class="alert-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="alert-content">
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('penjualantiket.submitPayment', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Metode Pembayaran -->
                        <div class="form-section">
                            <label class="form-label-custom">
                                Metode Pembayaran <span class="required">*</span>
                            </label>
                            <div class="payment-methods">
                                <label class="payment-option">
                                    <input type="radio" name="metode_pembayaran" value="transfer" class="payment-radio" {{ old('metode_pembayaran') == 'transfer' ? 'checked' : '' }}>
                                    <div class="payment-option-content">
                                        <i class="bi bi-bank2"></i>
                                        <div>
                                            <strong>Transfer Bank</strong>
                                            <small>Transfer langsung ke rekening admin</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="metode_pembayaran" value="e-wallet" class="payment-radio" {{ old('metode_pembayaran') == 'e-wallet' ? 'checked' : '' }}>
                                    <div class="payment-option-content">
                                        <i class="bi bi-wallet2"></i>
                                        <div>
                                            <strong>E-Wallet</strong>
                                            <small>SeaBank, Dana, OVO, ShopeePay, Gopay</small>
                                        </div>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="metode_pembayaran" value="cash" class="payment-radio" {{ old('metode_pembayaran') == 'cash' ? 'checked' : '' }}>
                                    <div class="payment-option-content">
                                        <i class="bi bi-cash-coin"></i>
                                        <div>
                                            <strong>Cash</strong>
                                            <small>Pembayaran tunai saat bertemu admin</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('metode_pembayaran')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Rekening Info -->
                        <div id="rekening-info" class="rekening-card" style="display: none;">
                            <div class="rekening-header">
                                <i class="bi bi-info-circle"></i>
                                <span>Informasi Rekening Basecamp</span>
                            </div>
                            <div class="rekening-body">
                                <div id="rekening-transfer" style="display: none;">
                                    <p><strong>Bank:</strong> BRI</p>
                                    <p><strong>Nomor Rekening:</strong> 1234-01-123456-50-0</p>
                                    <p><strong>Atas Nama:</strong> Basecamp Merbabu</p>
                                </div>
                                <div id="rekening-ewallet" style="display: none;">
                                    <p><strong>Dana/SeaBank/OVO/ShopeePay/Gopay:</strong> 0812-3456-7890</p>
                                    <p><strong>Atas Nama:</strong> Basecamp Merbabu</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div id="bukti-section" class="form-section" style="display: none;">
                            <label class="form-label-custom">
                                Bukti Pembayaran <span class="required">*</span>
                            </label>
                            <div class="upload-area" id="uploadArea">
                                <input type="file" name="bukti_pembayaran" id="buktiFile" accept="image/*" class="d-none">
                                <div id="upload-content">
                                    <i class="bi bi-cloud-arrow-up upload-icon"></i>
                                    <p><strong>Klik atau drag file gambar ke sini</strong></p>
                                    <small>Format: JPEG, PNG, JPG | Maksimal 2MB</small>
                                </div>
                                <div id="preview-content" style="display: none;">
                                    <img id="preview-image" src="#" alt="Preview">
                                    <p id="filename"></p>
                                </div>
                            </div>
                            @error('bukti_pembayaran')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div class="form-section">
                            <label class="form-label-custom">Catatan (Opsional)</label>
                            <textarea name="catatan_pembayaran" class="form-control-custom" rows="3" placeholder="Contoh: Sudah transfer ke BRI, No Ref: 123456">{{ old('catatan_pembayaran') }}</textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('penjualantiket.show', $transaksi->id) }}" class="btn-back">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="bi bi-send"></i> Kirim Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <!-- Verified Actions -->
            <div class="action-buttons-verified">
                <a href="{{ route('penjualantiket.show', $transaksi->id) }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('penjualantiket.print', $transaksi->id) }}" class="btn-print">
                    <i class="bi bi-printer"></i> Cetak Tiket
                </a>
            </div>
            @endif

        </div>
    </div>
</div>

<style>
/* Hero Section */
.payment-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
    padding: 120px 0 80px;
    text-align: center;
    overflow: hidden;
}

.payment-hero::before {
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

/* Status Alert */
.status-alert { display: flex; gap: 15px; padding: 20px; border-radius: 16px; }
.status-verified { background: #d1fae5; border: 1px solid #a7f3d0; }
.status-rejected { background: #fee2e2; border: 1px solid #fecaca; }
.status-icon { font-size: 28px; flex-shrink: 0; }
.status-verified .status-icon { color: #059669; }
.status-rejected .status-icon { color: #dc2626; }
.status-content strong { display: block; margin-bottom: 4px; }
.status-verified .status-content strong { color: #065f46; }
.status-rejected .status-content strong { color: #991b1b; }
.status-content p { margin: 0; font-size: 14px; }
.status-content small { display: block; margin-top: 8px; opacity: 0.8; }

/* Cards */
.info-card, .payment-card { background: #fff; border-radius: 20px; box-shadow: 0 10px 50px rgba(0,0,0,0.1); overflow: hidden; }
.card-header-custom { background: linear-gradient(135deg, #0f172a, #1e3a5f); color: #fff; padding: 20px 25px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
.payment-header { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
.card-body-custom { padding: 25px 30px; }

/* Info Grid */
.info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
.info-item { display: flex; flex-direction: column; gap: 4px; }
.info-label { font-size: 12px; color: #64748b; }
.info-value { font-weight: 600; color: #1e293b; font-size: 14px; }
.info-value.code { font-family: monospace; background: #f1f5f9; padding: 6px 12px; border-radius: 6px; display: inline-block; }

.total-section { display: flex; justify-content: space-between; align-items: center; padding-top: 20px; border-top: 2px dashed #e2e8f0; }
.total-label { font-weight: 600; color: #64748b; }
.total-value { font-size: 24px; font-weight: 700; color: #22c55e; }

/* Alert */
.alert-custom { display: flex; gap: 15px; border-radius: 12px; padding: 16px 20px; }
.alert-danger { background: #fef2f2; border: 1px solid #fecaca; }
.alert-icon { font-size: 24px; color: #dc2626; flex-shrink: 0; }

/* Form */
.form-section { margin-bottom: 25px; }
.form-label-custom { display: block; font-weight: 600; color: #1e293b; margin-bottom: 10px; font-size: 15px; }
.required { color: #dc2626; }
.error-text { color: #dc2626; font-size: 13px; margin-top: 8px; }

/* Payment Methods */
.payment-methods { display: flex; flex-direction: column; gap: 12px; }
.payment-option { cursor: pointer; }
.payment-radio { display: none; }
.payment-option-content { display: flex; align-items: center; gap: 15px; padding: 18px; border: 2px solid #e2e8f0; border-radius: 12px; transition: all 0.3s; }
.payment-option-content i { font-size: 24px; color: #64748b; }
.payment-option-content strong { display: block; color: #1e293b; }
.payment-option-content small { color: #64748b; font-size: 12px; }
.payment-radio:checked + .payment-option-content { border-color: #3b82f6; background: #eff6ff; }
.payment-radio:checked + .payment-option-content i { color: #3b82f6; }

/* Rekening Info */
.rekening-card { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; margin-bottom: 25px; overflow: hidden; }
.rekening-header { background: #dbeafe; padding: 12px 18px; font-weight: 600; color: #1d4ed8; display: flex; align-items: center; gap: 8px; font-size: 14px; }
.rekening-body { padding: 18px; }
.rekening-body p { margin: 0 0 8px 0; font-size: 14px; color: #1e293b; }
.rekening-body p:last-child { margin-bottom: 0; }

/* Upload Area */
.upload-area { border: 2px dashed #e2e8f0; border-radius: 12px; padding: 40px; text-align: center; cursor: pointer; transition: all 0.3s; background: #f8fafc; }
.upload-area:hover { border-color: #3b82f6; background: #eff6ff; }
.upload-icon { font-size: 48px; color: #3b82f6; margin-bottom: 15px; }
.upload-area p { margin: 0 0 5px 0; color: #1e293b; }
.upload-area small { color: #64748b; }
#preview-image { max-width: 100%; max-height: 200px; border-radius: 8px; }
#filename { margin-top: 10px; color: #64748b; font-size: 14px; }

/* Form Control */
.form-control-custom { width: 100%; padding: 14px 18px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 14px; transition: all 0.3s; resize: none; }
.form-control-custom:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); }

/* Action Buttons */
.action-buttons, .action-buttons-verified { display: flex; justify-content: space-between; align-items: center; margin-top: 30px; padding-top: 25px; border-top: 1px solid #e2e8f0; }
.btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 14px 24px; background: #f1f5f9; color: #64748b; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
.btn-back:hover { background: #e2e8f0; color: #475569; }
.btn-submit { display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #fff; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
.btn-submit:hover { transform: translateY(-2px); }
.btn-print { display: inline-flex; align-items: center; gap: 8px; padding: 14px 32px; background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s; }
.btn-print:hover { transform: translateY(-2px); color: #fff; }

@media (max-width: 768px) {
    .hero-title { font-size: 1.8rem; }
    .info-grid { grid-template-columns: 1fr; }
    .action-buttons, .action-buttons-verified { flex-direction: column-reverse; gap: 15px; }
    .btn-back, .btn-submit, .btn-print { width: 100%; justify-content: center; }
}
</style>

<script>
document.querySelectorAll('.payment-radio').forEach(el => {
    el.addEventListener('change', function() {
        const buktiSection = document.getElementById('bukti-section');
        const buktiInput = document.getElementById('buktiFile');
        const rekeningInfo = document.getElementById('rekening-info');
        const rekeningTransfer = document.getElementById('rekening-transfer');
        const rekeningEwallet = document.getElementById('rekening-ewallet');
        
        if (this.value === 'transfer') {
            buktiSection.style.display = 'block';
            buktiInput.setAttribute('required', 'required');
            rekeningInfo.style.display = 'block';
            rekeningTransfer.style.display = 'block';
            rekeningEwallet.style.display = 'none';
        } else if (this.value === 'e-wallet') {
            buktiSection.style.display = 'block';
            buktiInput.setAttribute('required', 'required');
            rekeningInfo.style.display = 'block';
            rekeningTransfer.style.display = 'none';
            rekeningEwallet.style.display = 'block';
        } else {
            buktiSection.style.display = 'none';
            buktiInput.removeAttribute('required');
            rekeningInfo.style.display = 'none';
            buktiInput.value = '';
            document.getElementById('upload-content').style.display = 'block';
            document.getElementById('preview-content').style.display = 'none';
        }
    });
});

const uploadArea = document.getElementById('uploadArea');
const fileInput = document.getElementById('buktiFile');

uploadArea?.addEventListener('click', () => fileInput.click());
fileInput?.addEventListener('change', handleFileSelect);

uploadArea?.addEventListener('dragover', e => { e.preventDefault(); uploadArea.style.borderColor = '#3b82f6'; uploadArea.style.background = '#eff6ff'; });
uploadArea?.addEventListener('dragleave', () => { uploadArea.style.borderColor = '#e2e8f0'; uploadArea.style.background = '#f8fafc'; });
uploadArea?.addEventListener('drop', e => { e.preventDefault(); uploadArea.style.borderColor = '#e2e8f0'; uploadArea.style.background = '#f8fafc'; fileInput.files = e.dataTransfer.files; handleFileSelect(); });

function handleFileSelect() {
    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-image').src = e.target.result;
            document.getElementById('filename').textContent = file.name;
            document.getElementById('upload-content').style.display = 'none';
            document.getElementById('preview-content').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

document.querySelectorAll('.payment-radio').forEach(el => { if (el.checked) el.dispatchEvent(new Event('change')); });
</script>

@endsection
