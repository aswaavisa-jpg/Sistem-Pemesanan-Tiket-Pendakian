@extends('layout')

@section('content')

<h2 class="mb-3">Tambah Pendaki</h2>

<form action="{{ route('pendaki.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Pendaki</label>
        <input type="text" name="nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>NIK</label>
        <input type="text" name="nik" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control" required>
            <option value="">--Pilih--</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('pendaki.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
