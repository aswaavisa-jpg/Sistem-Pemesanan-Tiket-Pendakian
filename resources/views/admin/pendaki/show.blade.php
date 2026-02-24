@extends('admin.layout')

@section('page-title', 'Detail Pendaki')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h5 style="margin: 0; color: #333; font-weight: 700;">
        <i class="bi bi-person-hiking"></i> Detail Data Pendaki
    </h5>
    <a href="{{ route('admin.pendaki.index') }}" class="btn btn-secondary" style="font-size: 14px;">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@if($pendaki && $pendaki->pendaki)
    <div class="card" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
        <div class="card-body" style="padding: 30px;">
            <!-- Foto Section -->
            @if($pendaki->pendaki->foto)
                <div style="margin-bottom: 30px; text-align: center;">
                    <img src="{{ asset('storage/' . $pendaki->pendaki->foto) }}" alt="{{ $pendaki->pendaki->nama }}" style="max-width: 200px; max-height: 200px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                </div>
                <hr style="margin: 20px 0; border-color: #eee;">
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Nama Lengkap</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->nama ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">NIK</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->nik ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">No. HP</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->no_hp ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">No. HP Darurat</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #dc3545; font-weight: 600;">{{ $pendaki->pendaki->no_hp_darurat ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Jenis Kelamin</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">
                            @if($pendaki->pendaki->jenis_kelamin === 'Laki-laki')
                                Laki-laki
                            @elseif($pendaki->pendaki->jenis_kelamin === 'Perempuan')
                                Perempuan
                            @else
                                {{ $pendaki->pendaki->jenis_kelamin ?? '-' }}
                            @endif
                        </p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Tanggal Lahir</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">
                            @if($pendaki->pendaki->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($pendaki->pendaki->tanggal_lahir)->format('d F Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Alamat</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->alamat ?? '-' }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Provinsi</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->provinsi ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Kabupaten</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->kabupaten ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Kecamatan</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->kecamatan ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Desa</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->desa ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Dusun</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->dusun ?? '-' }}</p>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">RT/RW</label>
                        <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pendaki->rt_rw ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <hr style="margin: 30px 0; border-color: #eee;">

            <!-- Detail Pemesanan Section -->
            <h6 style="color: #333; font-weight: 700; margin-bottom: 20px;">
                <i class="bi bi-calendar-check"></i> Informasi Pemesanan
            </h6>
            
            @if($pendaki->pemesanan)
                @php
                    $isOverdue = false;
                    if (($pendaki->status_pendakian ?? 'aktif') === 'aktif' && $pendaki->pemesanan?->tgl_turun) {
                        $today = \Carbon\Carbon::today();
                        $tglTurun = \Carbon\Carbon::parse($pendaki->pemesanan->tgl_turun)->startOfDay();
                        if ($today->gt($tglTurun)) {
                            $isOverdue = true;
                        }
                    }
                @endphp
                <div class="row">
                    <div class="col-md-6">
                        <div style="margin-bottom: 20px;">
                            <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Jalur Pendakian</label>
                            <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pemesanan->jalur_pendakian ?? '-' }}</p>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Tanggal Naik</label>
                            <p style="margin: 5px 0; font-size: 16px; color: #333;">
                                @if($pendaki->pemesanan->tgl_naik)
                                    {{ \Carbon\Carbon::parse($pendaki->pemesanan->tgl_naik)->format('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div style="margin-bottom: 20px;">
                            <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Tanggal Turun</label>
                            <p style="margin: 5px 0; font-size: 16px; color: {{ $isOverdue ? '#dc3545' : '#333' }}; font-weight: {{ $isOverdue ? 'bold' : 'normal' }}">
                                @if($pendaki->pemesanan->tgl_turun)
                                    {{ \Carbon\Carbon::parse($pendaki->pemesanan->tgl_turun)->format('d F Y') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Jumlah Anggota</label>
                            <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pendaki->pemesanan->jumlah_anggota ?? '-' }} orang</p>
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Status Pendakian</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">
                        @if($pendaki->status_pendakian === 'aktif')
                            @if($isOverdue)
                                <span class="badge bg-danger"><i class="bi bi-exclamation-triangle-fill"></i> Terlambat Turun!</span>
                            @else
                                <span class="badge bg-warning text-dark">Aktif</span>
                            @endif
                        @elseif($pendaki->status_pendakian === 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($pendaki->status_pendakian === 'batal')
                            <span class="badge bg-danger">Batal</span>
                        @else
                            {{ $pendaki->status_pendakian ?? '-' }}
                        @endif
                    </p>
                </div>
            @else
                <p class="text-muted" style="font-style: italic;">Tidak ada informasi pemesanan</p>
            @endif

            <hr style="margin: 30px 0; border-color: #eee;">

            <!-- Dokumen Pendukung Section -->
            <h6 style="color: #333; font-weight: 700; margin-bottom: 20px;">
                <i class="bi bi-file-earmark-person"></i> Dokumen Pendukung
            </h6>
            
            <div class="row">
                <div class="col-md-6">
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 10px;">Foto KTP</label>
                        @if($pendaki->pendaki->foto_ktp)
                            <div style="padding: 5px; border: 1px solid #eee; border-radius: 8px; display: inline-block;">
                                <a href="{{ asset('storage/' . $pendaki->pendaki->foto_ktp) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $pendaki->pendaki->foto_ktp) }}" alt="KTP" style="max-height: 200px; max-width: 100%; border-radius: 4px;">
                                </a>
                            </div>
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="margin-bottom: 20px;">
                        <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase; display: block; margin-bottom: 10px;">Foto Selfie</label>
                        @if($pendaki->pendaki->foto_selfie)
                            <div style="padding: 5px; border: 1px solid #eee; border-radius: 8px; display: inline-block;">
                                <a href="{{ asset('storage/' . $pendaki->pendaki->foto_selfie) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $pendaki->pendaki->foto_selfie) }}" alt="Selfie" style="max-height: 200px; max-width: 100%; border-radius: 4px;">
                                </a>
                            </div>
                        @else
                            <p class="text-muted">-</p>
                        @endif
                    </div>
                </div>
            </div>

            <hr style="margin: 30px 0; border-color: #eee;">

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                @if($pendaki->status_pendakian === 'aktif')
                    <form action="{{ route('admin.pendaki.confirmDescent', $pendaki->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Konfirmasi pendaki sudah laporan turun?')">
                        @csrf
                        <button type="submit" class="btn btn-success" style="font-size: 14px;">
                            <i class="bi bi-check-circle"></i> Konfirmasi Turun
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.pendaki.destroy', $pendaki->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus data pendaki ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="font-size: 14px;">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
                <a href="{{ route('admin.pendaki.index') }}" class="btn btn-secondary" style="font-size: 14px;">
                    <i class="bi bi-x-circle"></i> Tutup
                </a>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning" role="alert">
        <i class="bi bi-exclamation-triangle"></i> Data pendaki tidak ditemukan
    </div>
@endif

@endsection
