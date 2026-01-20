@extends('layout')

@section('content')

<h2 class="mb-3">Data Detail Pendaki</h2>

<a href="{{ route('detail.create') }}" class="btn btn-primary mb-3">+ Tambah Detail Pendaki</a>

<table class="table table-bordered table-striped">
    <thead class="table-info">
        <tr>
            <th>No</th>
            <th>Pemesanan</th>
            <th>Pendaki</th>
            <th width="160px">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($detail as $d)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->pemesanan->id_pemesanan }}</td>
            <td>{{ $d->pendaki->nama }}</td>

            <td>
                <a href="{{ route('detail.edit', $d->id_detail) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('detail.destroy', $d->id_detail) }}" method="POST"
                      class="d-inline" onsubmit="return confirm('Hapus data ini?')">
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
