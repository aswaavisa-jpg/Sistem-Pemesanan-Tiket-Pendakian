@extends('layout')

@section('content')

<h2 class="mb-3">Tambah Jadwal Pendakian</h2>

<form action="{{ route('jadwal.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Gunung</label>
        <select name="id_gunung" class="form-control" required>
            <option value="">-- Pilih Gunung --</option>
            @foreach ($gunung as $g)
                <option value="{{ $g->id_gunung }}">{{ $g->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Naik</label>
        <input type="date" name="tgl_naik" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Turun</label>
        <input type="date" name="tgl_turun" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Kapasitas</label>
        <input type="number" name="kapasitas" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
