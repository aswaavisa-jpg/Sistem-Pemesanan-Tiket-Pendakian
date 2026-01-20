@extends('layout')

@section('content')

<h2 class="mb-3">Edit Pemesanan</h2>

<form action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Pemesan</label>
        <select name="id_pendaki" class="form-control" required>
            @foreach ($pendaki as $p)
                <option value="{{ $p->id_pendaki }}"
                    {{ $p->id_pendaki == $pemesanan->id_pendaki ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Gunung</label>
        <select name="id_gunung" class="form-control" required>
            @foreach ($gunung as $g)
                <option value="{{ $g->id_gunung }}"
                    {{ $g->id_gunung == $pemesanan->id_gunung ? 'selected' : '' }}>
                    {{ $g->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Jadwal Pendakian</label>
        <select name="id_jadwal" class="form-control" required>
            @foreach ($jadwal as $j)
                <option value="{{ $j->id_jadwal }}"
                    {{ $j->id_jadwal == $pemesanan->id_jadwal ? 'selected' : '' }}>
                    {{ $j->gunung->nama }} | {{ $j->tgl_naik }} - {{ $j->tgl_turun }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Jumlah Anggota</label>
        <input type="number" name="jumlah_anggota"
               class="form-control"
               value="{{ $pemesanan->jumlah_anggota }}" required>
    </div>

    <div class="mb-3">
        <label>Tanggal Pesan</label>
        <input type="date" name="tanggal_pesan"
               class="form-control"
               value="{{ $pemesanan->tanggal_pesan }}" required>
    </div>

    <button class="btn btn-warning">Update</button>
    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>

</form>

@endsection
