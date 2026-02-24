@extends('admin.layout')

@section('page-title', 'Detail Pemesanan')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h5 style="margin: 0; color: #333; font-weight: 700;">
        <i class="bi bi-calendar-check"></i> Detail Pemesanan #{{ $pemesanan->id }}
    </h5>
    <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary" style="font-size: 14px;">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
    <div class="card-body" style="padding: 30px;">
        <h6 style="color: #666; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
            <i class="bi bi-info-circle"></i> Informasi Pemesanan
        </h6>

        <div class="row">
            <div class="col-md-6">
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">ID Pemesanan</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">#{{ $pemesanan->id }}</p>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Jalur Pendakian</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ $pemesanan->jalur_pendakian }}</p>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Tanggal Naik</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ \Carbon\Carbon::parse($pemesanan->tgl_naik)->format('d F Y') }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Tanggal Turun</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ \Carbon\Carbon::parse($pemesanan->tgl_turun)->format('d F Y') }}</p>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Jumlah Anggota</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">
                        <span class="badge bg-info" style="font-size: 14px; padding: 8px 12px;">{{ $pemesanan->jumlah_anggota }} orang</span>
                    </p>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="font-weight: 600; color: #666; font-size: 12px; text-transform: uppercase;">Dibuat Pada</label>
                    <p style="margin: 5px 0; font-size: 16px; color: #333;">{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>

        <hr style="margin: 30px 0; border-color: #eee;">

        <h6 style="color: #666; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
            <i class="bi bi-people"></i> Daftar Pendaki
        </h6>

        @if($pemesanan->details && $pemesanan->details->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover" style="margin-bottom: 0;">
                    <thead>
                        <tr style="background-color: #f8f9fa;">
                            <th>No</th>
                            <th>Nama Pendaki</th>
                            <th>NIK</th>
                            <th>No HP</th>
                            <th>Status Pendakian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesanan->details as $key => $detail)
                            <tr>
                                <td><strong>{{ $key + 1 }}</strong></td>
                                <td>{{ $detail->pendaki->nama ?? '-' }}</td>
                                <td>{{ $detail->pendaki->nik ?? '-' }}</td>
                                <td>{{ $detail->pendaki->no_hp ?? '-' }}</td>
                                <td>
                                    @if($detail->status_pendakian)
                                        <span class="badge bg-success">{{ $detail->status_pendakian }}</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info" role="alert" style="margin-bottom: 20px;">
                <i class="bi bi-info-circle"></i> Belum ada pendaki terdaftar untuk pemesanan ini.
            </div>
        @endif

        <hr style="margin: 30px 0; border-color: #eee;">

        <div style="display: flex; gap: 10px;">
            <form action="{{ route('admin.pemesanan.destroy', $pemesanan->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus pemesanan ini? Data pendaki yang terkait juga akan dihapus.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="font-size: 14px;">
                    <i class="bi bi-trash"></i> Hapus
                </button>
            </form>
            <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary" style="font-size: 14px;">
                <i class="bi bi-x-circle"></i> Tutup
            </a>
        </div>
    </div>
</div>

@endsection
