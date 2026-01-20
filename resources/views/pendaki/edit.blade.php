@extends('layout')

@section('content')

<h2 class="mb-3">Edit Pendaki</h2>

<form action="{{ route('pendaki.update', $pendaki->id_pendaki) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Pendaki</label>
        <input type="text" name="nama" value="{{ $pendaki->nama }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>NIK</label>
        <input type="text" name="nik" value="{{ $pendaki->nik }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="Laki-laki" {{ $pendaki->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $pendaki->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ $pendaki->no_hp }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required>{{ $pendaki->alamat }}</textarea>
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('pendaki.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
