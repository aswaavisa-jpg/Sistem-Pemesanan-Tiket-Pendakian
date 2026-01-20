@extends('layout')

@section('content')

<h2 class="mb-3">Data Jadwal Pendakian</h2>

<a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">+ Tambah Jadwal</a>

<table class="table table-bordered table-striped">
    <thead class="table-warning">
        <tr>
            <th>No</th>
            <th>Gunung</th>
            <th>Tanggal Naik</th>
            <th>Tanggal Turun</th>
            <th>Kapasitas</th>
            <th width="150px">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($jadwal as $j)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $j->gunung->nama }}</td>
            <td>{{ $j->tgl_naik }}</td>
            <td>{{ $j->tgl_turun }}</td>
            <td>{{ $j->kapasitas }}</td>

            <td>
                <a href="{{ route('jadwal.edit', $j->id_jadwal) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('jadwal.destroy', $j->id_jadwal) }}"
                      method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus jadwal ini?')">
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
