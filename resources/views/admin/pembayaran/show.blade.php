@extends('admin.layout')

@section('page-title', 'Detail Verifikasi Pembayaran')

@section('content')

<h5 style="margin-bottom: 20px; color: #333; font-weight: 700;">
    <i class="bi bi-credit-card-2-front"></i> Detail Verifikasi Pembayaran
</h5>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-exclamation-triangle"></i> <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- Informasi Transaksi & Pembayaran -->
    <div class="col-lg-7">
        <!-- Informasi Transaksi -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-dark text-white fw-semibold">
                <i class="bi bi-receipt"></i> Informasi Transaksi
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Kode Tiket</th>
                        <td class="fw-bold">{{ $pembayaran->kode_tiket }}</td>
                    </tr>
                    <tr>
                        <th>Nama Pendaki</th>
                        <td>{{ $pembayaran->nama_pendaki }}</td>
                    </tr>
                    <tr>
                        <th>Jalur Pendakian</th>
                        <td>{{ $pembayaran->pemesanan?->jalur_pendakian ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pendakian</th>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pendakian)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tiket</th>
                        <td>{{ $pembayaran->jumlah_tiket }} tiket</td>
                    </tr>
                    <tr>
                        <th>Harga per Orang</th>
                        <td>Rp {{ number_format($pembayaran->harga_per_orang, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-top border-bottom">
                        <th>Total Harga</th>
                        <td class="fw-bold text-success fs-5">
                            Rp {{ number_format($pembayaran->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $pembayaran->created_at->format('d M Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Data Pendaki -->
        <div class="mb-4">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                <div style="width: 4px; height: 24px; background-color: #333; border-radius: 2px;"></div>
                <h6 style="margin: 0; font-weight: 700; color: #333; text-transform: uppercase; letter-spacing: 0.5px; font-size: 14px;">
                    Daftar Pendaki ({{ $pembayaran->pemesanan->pendakis->count() }} Orang)
                </h6>
            </div>

            @if($pembayaran->pemesanan && $pembayaran->pemesanan->pendakis->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    @foreach($pembayaran->pemesanan->pendakis as $index => $item)
                        <div class="card shadow-sm border-0" style="border-radius: 12px; overflow: hidden; background: #fff;">
                            <div style="padding: 15px 20px; background: #f8f9fa; border-bottom: 1px solid #edf2f7; display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="width: 28px; height: 28px; background: #333; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold;">
                                        {{ $index + 1 }}
                                    </span>
                                    <span style="font-weight: 700; color: #333; font-size: 16px;">{{ $item->pendaki->nama ?? '-' }}</span>
                                </div>
                                <span class="badge" style="background: {{ $item->pendaki->jenis_kelamin == 'Laki-laki' ? '#e1f5fe' : '#fce4ec' }}; color: {{ $item->pendaki->jenis_kelamin == 'Laki-laki' ? '#0288d1' : '#d81b60' }}; font-weight: 600; padding: 6px 12px; border-radius: 20px; font-size: 11px;">
                                    <i class="bi bi-{{ $item->pendaki->jenis_kelamin == 'Laki-laki' ? 'gender-male' : 'gender-female' }}"></i> 
                                    {{ $item->pendaki->jenis_kelamin ?? '-' }}
                                </span>
                            </div>
                            <div class="card-body" style="padding: 20px;">
                                <div class="row g-3">
                                    <div class="col-md-6 border-end">
                                        <div style="margin-bottom: 12px;">
                                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">NIK / No. Identitas</div>
                                            <div style="font-size: 14px; color: #333; font-weight: 500;"><i class="bi bi-person-vcard text-muted me-2"></i> {{ $item->pendaki->nik ?? '-' }}</div>
                                        </div>
                                        <div>
                                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Tanggal Lahir</div>
                                            <div style="font-size: 14px; color: #333; font-weight: 500;">
                                                <i class="bi bi-calendar3 text-muted me-2"></i>
                                                {{ $item->pendaki->tanggal_lahir ? \Carbon\Carbon::parse($item->pendaki->tanggal_lahir)->format('d F Y') : '-' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 12px;">
                                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Informasi Kontak</div>
                                            <div style="display: flex; gap: 15px;">
                                                <div style="font-size: 13px; color: #333;"><i class="bi bi-phone text-muted me-1"></i> {{ $item->pendaki->no_hp ?? '-' }}</div>
                                                <div style="font-size: 13px; color: #dc3545; font-weight: 600;"><i class="bi bi-telephone-plus me-1"></i> {{ $item->pendaki->no_hp_darurat ?? '-' }} <span style="font-size: 10px; font-weight: normal; opacity: 0.8;">(Darurat)</span></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div style="font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: 700; margin-bottom: 4px;">Domisili / Alamat</div>
                                            <div style="font-size: 13px; color: #475569; line-height: 1.5;">
                                                <i class="bi bi-geo-alt text-muted me-1"></i>
                                                @if($item->pendaki->alamat)
                                                    {{ $item->pendaki->alamat }}
                                                @else
                                                    {{ collect([
                                                        $item->pendaki->dusun,
                                                        $item->pendaki->desa,
                                                        $item->pendaki->rt_rw,
                                                        $item->pendaki->kecamatan,
                                                        $item->pendaki->kabupaten,
                                                        $item->pendaki->provinsi
                                                    ])->filter()->implode(', ') ?: '-' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card shadow-sm border-0 py-4 text-center" style="border-radius: 12px; background: #fff;">
                    <i class="bi bi-people text-muted mb-2" style="font-size: 2rem;"></i>
                    <p class="text-muted mb-0">Tidak ada data pendaki</p>
                </div>
            @endif
        </div>

        <!-- Informasi Pembayaran -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white fw-semibold">
                <i class="bi bi-credit-card"></i> Informasi Pembayaran
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="35%">Status</th>
                        <td>
                            @if($pembayaran->isPending())
                                <span class="badge bg-warning" style="padding: 8px 12px; font-size: 13px;">
                                    <i class="bi bi-clock"></i> Menunggu Verifikasi
                                </span>
                            @elseif($pembayaran->isVerified())
                                <span class="badge bg-success" style="padding: 8px 12px; font-size: 13px;">
                                    <i class="bi bi-check-circle"></i> Terverifikasi
                                </span>
                            @else
                                <span class="badge bg-danger" style="padding: 8px 12px; font-size: 13px;">
                                    <i class="bi bi-x-circle"></i> Ditolak
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>
                            @if($pembayaran->metode_pembayaran)
                                @switch($pembayaran->metode_pembayaran)
                                    @case('transfer')
                                        <i class="bi bi-bank2"></i> Transfer Bank
                                        @break
                                    @case('e-wallet')
                                        <i class="bi bi-wallet2"></i> E-Wallet
                                        @break
                                    @case('cash')
                                        <i class="bi bi-cash-coin"></i> Cash
                                        @break
                                    @default
                                        {{ $pembayaran->metode_pembayaran }}
                                @endswitch
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @if($pembayaran->bukti_pembayaran)
                    <tr>
                        <th>Bukti Pembayaran</th>
                        <td>
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-image"></i> Lihat Gambar
                            </a>
                        </td>
                    </tr>
                    @endif
                    @if($pembayaran->verified_at)
                    <tr class="border-top">
                        <th>Diverifikasi Oleh</th>
                        <td>{{ $pembayaran->verifiedBy?->name ?? 'Admin' }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Verifikasi</th>
                        <td>{{ $pembayaran->verified_at->format('d M Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <!-- Panel Verifikasi -->
    <div class="col-lg-5">
        @if($pembayaran->isPending())
        <div class="card shadow-sm border-0 mb-4" style="border-left: 4px solid #ffc107;">
            <div class="card-header bg-light fw-semibold">
                <i class="bi bi-exclamation-circle"></i> Perlu Diverifikasi
            </div>
            <div class="card-body text-muted">
                <p>Silakan periksa bukti pembayaran dan verifikasi pembayaran dari user ini.</p>
            </div>
        </div>

        <!-- Form Verifikasi -->
        <div class="card shadow-sm border-0 mb-3" style="border-left: 4px solid #198754;">
            <div class="card-header bg-success text-white fw-semibold">
                <i class="bi bi-check2-circle"></i> Setujui Pembayaran
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pembayaran.verify', $pembayaran->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Catatan Verifikasi (Opsional)</label>
                        <textarea class="form-control" name="catatan_verifikasi" rows="3" placeholder="Contoh: Pembayaran sudah diterima, tiket valid"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100 fw-semibold">
                        <i class="bi bi-check-circle"></i> Verifikasi Pembayaran
                    </button>
                </form>
            </div>
        </div>

        <!-- Form Penolakan -->
        <div class="card shadow-sm border-0" style="border-left: 4px solid #dc3545;">
            <div class="card-header bg-danger text-white fw-semibold">
                <i class="bi bi-x-circle"></i> Tolak Pembayaran
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pembayaran.reject', $pembayaran->id) }}" method="POST" onsubmit="return confirm('Yakin tolak pembayaran ini?')">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alasan_penolakan') is-invalid @enderror" 
                                  name="alasan_penolakan" rows="3" 
                                  placeholder="Contoh: Bukti tidak jelas, nominal tidak sesuai, dll" 
                                  required></textarea>
                        @error('alasan_penolakan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-danger w-100 fw-semibold">
                        <i class="bi bi-x-circle"></i> Tolak Pembayaran
                    </button>
                </form>
            </div>
        </div>
        @else
        <!-- Status Sudah Diverifikasi -->
        <div class="card shadow-sm border-0" style="border-left: 4px solid {{ $pembayaran->isVerified() ? '#198754' : '#dc3545' }};">
            <div class="card-header {{ $pembayaran->isVerified() ? 'bg-success' : 'bg-danger' }} text-white fw-semibold">
                <i class="bi bi-{{ $pembayaran->isVerified() ? 'check-circle' : 'x-circle' }}"></i> 
                {{ $pembayaran->isVerified() ? 'Pembayaran Disetujui' : 'Pembayaran Ditolak' }}
            </div>
            <div class="card-body">
                @if($pembayaran->catatan_verifikasi)
                <div class="mb-3">
                    <strong>Catatan:</strong>
                    <p class="text-muted">{{ $pembayaran->catatan_verifikasi }}</p>
                </div>
                @endif

                <div class="mb-3">
                    <strong>Diverifikasi Oleh:</strong>
                    <p class="text-muted">{{ $pembayaran->verifiedBy?->name ?? 'Admin' }}</p>
                </div>

                <div>
                    <strong>Waktu Verifikasi:</strong>
                    <p class="text-muted">{{ $pembayaran->verified_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Tombol Kembali -->
<div style="margin-top: 20px;">
    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@endsection
