@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="py-5 text-center"
     style="background: linear-gradient(#87CEEB); color:white;">
    <div class="container">
        <h2 class="fw-bold mb-2">Detail Pendaki</h2>
        <p class="mb-0 opacity-75">
            Data anggota pendaki dalam satu pemesanan
        </p>
    </div>
</div>

{{-- ================= CONTENT ================= --}}
<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Anggota Pendaki</h5>
        <a href="{{ route('detailpendaki.create') }}"
           class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Pendaki
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pendaki</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($detailpendaki as $dp)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $dp->pendaki->nama }}</td>
                                <td>{{ $dp->pendaki->nik }}</td>
                                <td class="text-center">{{ $dp->pendaki->jenis_kelamin }}</td>
                                <td class="text-center">
                                    <form action="{{ route('detailpendaki.destroy', $dp->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada data pendaki
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection
