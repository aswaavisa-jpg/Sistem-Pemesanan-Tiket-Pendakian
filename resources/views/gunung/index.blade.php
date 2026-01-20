@extends('layout')
@section('content')

<h2 class="mb-3">Data Gunung</h2>

<a href="{{ route('gunung.create') }}" class="btn btn-primary mb-3">+ Tambah Gunung</a>

<table class="table table-bordered table-striped">
    <thead class="table-success">
        <tr>
            <th>Nama Gunung</th>
            <th>Status</th>
            <th>Jalur Pendakian</th>
            <th width="150px">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($gunung as $g)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->lokasi }}</td>
            <td>{{ $g->ketinggian }} mdpl</td>
            <td>{{ $g->deskripsi }}</td>

            <td>
                <a href="{{ route('gunung.edit', $g->id_gunung) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('gunung.destroy', $g->id_gunung) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus gunung ini?')">
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
