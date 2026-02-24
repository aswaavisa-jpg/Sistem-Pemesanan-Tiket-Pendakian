@extends('admin.layout')

@section('page-title', 'Daftar Pemesanan')

@section('content')

<h5 style="margin-bottom: 20px; color: #333; font-weight: 700;">
    <i class="bi bi-calendar-check"></i> Daftar Pemesanan
</h5>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-container">
    @if($pemesanan->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jalur</th>
                        <th>Tanggal Naik</th>
                        <th>Tanggal Turun</th>
                        <th>Jumlah Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanan as $item)
                        <tr>
                            <td><strong>#{{ $item->id }}</strong></td>
                            <td>{{ $item->jalur_pendakian }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_naik)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_turun)->format('d M Y') }}</td>
                            <td><span class="badge bg-info">{{ $item->jumlah_anggota }} orang</span></td>
                            <td>
                                <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="btn-view">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ route('admin.pemesanan.edit', $item->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.pemesanan.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus pemesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: center; margin-top: 20px;">
            {{ $pemesanan->links() }}
        </div>
    @else
        <p class="text-muted text-center" style="padding: 40px 0;">
            <i class="bi bi-inbox" style="font-size: 32px;"></i><br>
            Belum ada pemesanan
        </p>
    @endif
</div>

@endsection
