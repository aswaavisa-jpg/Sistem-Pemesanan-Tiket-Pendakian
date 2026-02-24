@extends('layout')

@section('content')

<h2 class="mb-3">Edit Pendaki</h2>

<form action="{{ route('pendaki.update', $pendaki->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Pendaki</label>
        <input type="text" name="nama" value="{{ $pendaki->nama }}" class="form-control @error('nama') is-invalid @enderror" required>
        @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>NIK</label>
        <input type="text" name="nik" value="{{ $pendaki->nik }}" class="form-control @error('nik') is-invalid @enderror" required>
        @error('nik')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
            <option value="Laki-laki" {{ $pendaki->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $pendaki->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ $pendaki->tanggal_lahir }}" class="form-control @error('tanggal_lahir') is-invalid @enderror" required>
        @error('tanggal_lahir')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ $pendaki->no_hp }}" class="form-control @error('no_hp') is-invalid @enderror" required>
        @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ $pendaki->alamat }}</textarea>
        @error('alamat')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="mb-3">
        <label for="foto">Foto</label>
        @if($pendaki->foto)
            <div class="mb-2">
                <img src="{{ asset('storage/' . $pendaki->foto) }}" alt="{{ $pendaki->nama }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                <p class="text-muted small">Foto saat ini</p>
            </div>
        @endif
        <input type="file" id="foto" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
        <small class="text-muted">Pilih file baru untuk mengganti foto (Format: JPG, PNG, GIF, Max 2MB)</small>
        @error('foto')<small class="text-danger d-block">{{ $message }}</small>@enderror
    </div>

    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ route('pendaki.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
