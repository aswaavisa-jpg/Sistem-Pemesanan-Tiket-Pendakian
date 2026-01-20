@extends('layout')

@section('content')

<h2 class="mb-3">Data Pendaki</h2>

<a href="{{ route('pendaki.create') }}" class="btn btn-primary mb-3">+ Tambah Pendaki</a>

<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>Nama</th>
            <th>NIK</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Alamat</th>@extends('layout')

@section('content')

{{-- ================= HEADER ================= --}}
<div class="text-center text-white"
     style="background:linear-gradient(#87CEEB); padding:140px 0 80px;">
    <div class="container">
        <h2 class="fw-bold mb-2">Data Pendaki</h2>
        <p class="mb-0 opacity-75">
            Berikut adalah data lengkap pendaki yang sudah terdaftar
        </p>
    </div>
</div>

{{-- ================= CONTENT ================= --}}
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Daftar Pendaki</h5>
        <a href="{{ route('pendaki.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Pendaki
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendaki as $p)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->nik }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->no_hp }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td class="text-center">
                                    <a href="{{ route('pendaki.edit', $p->id) }}"
                                       class="btn btn-sm btn-outline-primary mb-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('pendaki.destroy', $p->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
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

            <th width="150px">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($pendaki as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->nik }}</td>
            <td>{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->no_hp }}</td>
            <td>{{ $p->alamat }}</td>
            <td>
                <a href="{{ route('pendaki.edit', $p->id_pendaki) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('pendaki.destroy', $p->id_pendaki) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
