@extends('layout')

@section('content')

<h2 class="mb-3">Tambah Data Gunung</h2>

<form action="{{ route('gunung.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Gunung</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Ketinggian (Mdpl)</label>
        <input type="number" name="ketinggian" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('gunung.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
