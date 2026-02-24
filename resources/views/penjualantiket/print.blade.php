@extends('layout')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0" style="font-family: 'Courier New', monospace;">
                <div class="card-body p-5 text-center">
                    
                    {{-- Header --}}
                    <div class="mb-4">
                        <h4 class="fw-bold mb-1">TIKET PENDAKIAN</h4>
                        <p class="text-muted small mb-0">Bukit Merbabu Adventure</p>
                    </div>

                    <hr class="my-3">

                    {{-- Kode Tiket --}}
                    <div class="mb-4">
                        <p class="text-muted small mb-1">KODE TIKET</p>
                        <h5 class="fw-bold text-primary" style="letter-spacing: 2px;">
                            {{ $transaksi->kode_tiket }}
                        </h5>
                    </div>

                    <hr class="my-3">

                    {{-- Detail Tiket --}}
                    <div class="mb-4 text-start">
                        <div class="row mb-2">
                            <div class="col-6 text-muted small">Jalur Pendakian</div>
                            <div class="col-6 fw-semibold text-end">
                                {{ $transaksi->pemesanan->jalur_pendakian ?? $transaksi->nama_pendaki }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6 text-muted small">Tanggal Mulai</div>
                            <div class="col-6 fw-semibold text-end">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_pendakian)->format('d-m-Y') }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6 text-muted small">Tanggal Selesai</div>
                            <div class="col-6 fw-semibold text-end">
                                {{ \Carbon\Carbon::parse($transaksi->pemesanan->tgl_turun ?? $transaksi->tanggal_pendakian)->format('d-m-Y') }}
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6 text-muted small">Jumlah Pendaki</div>
                            <div class="col-6 fw-semibold text-end">
                                {{ $transaksi->jumlah_tiket }} orang
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- Daftar Pendaki --}}
                    <div class="mb-4 text-start">
                        <p class="text-muted small mb-2">DAFTAR PENDAKI</p>
                        <table class="table table-sm table-borderless mb-0" style="font-size: 14px;">
                            <tbody>
                                @foreach($transaksi->pemesanan->pendakis as $idx => $detail)
                                <tr>
                                    <td style="width: 25px;" class="align-top text-muted">{{ $idx + 1 }}.</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $detail->pendaki->nama }}</div>
                                        <div class="small text-muted" style="font-size: 11px; line-height: 1.3;">
                                            NIK: {{ $detail->pendaki->nik }} | {{ $detail->pendaki->jenis_kelamin }}<br>
                                            HP: {{ $detail->pendaki->no_hp }} | Darurat: {{ $detail->pendaki->no_hp_darurat }}<br>
                                            Alamat: {{ collect([$detail->pendaki->dusun, $detail->pendaki->desa, $detail->pendaki->kecamatan, $detail->pendaki->kabupaten, $detail->pendaki->provinsi])->filter()->implode(', ') ?: '-' }}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-3">

                    {{-- Harga --}}
                    <div class="mb-4 text-start">
                        <div class="row mb-2">
                            <div class="col-6 text-muted small">Harga per Orang</div>
                            <div class="col-6 fw-semibold text-end">
                                Rp {{ number_format($transaksi->harga_per_orang, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 fw-bold">Total Harga</div>
                            <div class="col-6 fw-bold text-end text-success" style="font-size: 18px;">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <hr class="my-3">

                    {{-- Footer --}}
                    <div class="mb-3">
                        <p class="text-muted small mb-1">Tanggal Transaksi</p>
                        <p class="small">{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }} WIB</p>
                    </div>

                    <hr class="my-3">

                    {{-- QR Code --}}
                    <div class="mb-3">
                        <p class="text-muted small mb-2">SCAN QR CODE</p>
                        <div id="qrcode-print" style="display: inline-block; padding: 10px; border: 2px solid #e2e8f0; border-radius: 12px;"></div>
                        <p class="text-muted small mt-2">Scan untuk melihat detail pemesanan & status pembayaran</p>
                        <p class="text-danger small mt-2 mb-0">
                            <i class="bi bi-wifi"></i> 
                            <strong>⚠️ Perhatian:</strong> Scan QR code harus menggunakan jaringan WiFi yang sama dengan server
                        </p>
                    </div>

                    <div class="alert alert-info small mb-0" role="alert">
                        <strong>Penting:</strong> Simpan tiket ini dengan baik. Tunjukkan tiket di basecamp pendakian.
                    </div>

                </div>
            </div>

            {{-- Print Button --}}
            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary me-2">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <a href="{{ route('penjualantiket.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            background: white !important;
            padding: 0 !important;
        }
        .container {
            max-width: 100% !important;
            padding: 0 !important;
        }
        .btn {
            display: none !important;
        }
        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
        #qrcode-print img {
            display: block !important;
        }
        #qrcode-print canvas {
            display: none !important;
        }
    }
</style>

<!-- QR Code Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var qrcodeEl = document.getElementById('qrcode-print');
    if (qrcodeEl) {
        new QRCode(qrcodeEl, {
            text: "{{ config('app.url') }}/tiket/scan/{{ $transaksi->kode_tiket }}",
            width: 150,
            height: 150,
            colorDark: "#0f172a",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }
});
</script>

@endsection
