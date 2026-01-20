@extends('layout')

@section('content')

<h2 class="mb-3">Edit Data Gunung</h2>

<form action="{{ route('gunung.update', $gunung->id_gunung) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Gunung</label>
        <input type="text" name="nama" class="form-control" value="{{ $gunung->nama }}" required>
    </div>

    <div class="mb-3">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" value="{{ $gunung->lokasi }}" required>
    </div>

    <div class="mb-3">
        <label>Ketinggian (Mdpl)</label>
        <input type="number" name="ketinggian" class="form-control" value="{{ $gunung->ketinggian }}" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control">{{ $gunung->deskripsi }}</textarea>
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('gunung.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
