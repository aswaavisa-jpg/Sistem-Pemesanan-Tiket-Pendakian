@extends('layout')

@section('content')

<h2 class="mb-3">Edit Jadwal Pendakian</h2>

<form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Gunung</label>
        <select name="id_gunung" class="form-control" required>
            @foreach ($gunung as $g)
                <option value="{{ $g->id_gunung }}"
                    {{ $g->id_gunung == $jadwal->id_gunung ? 'selected' : '' }}>
                    {{ $g->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Naik</label>
        <input type="date" name="tgl_naik" value="{{ $jadwal->tgl_naik }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Turun</label>
        <input type="date" name="tgl_turun" value="{{ $jadwal->tgl_turun }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Kapasitas</label>
        <input type="number" name="kapasitas" value="{{ $jadwal->kapasitas }}" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
