@extends('layout')

@section('content')

<h2 class="mb-3">Edit Detail Pendaki</h2>

<form action="{{ route('detail.update', $detail->id_detail) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Pemesanan</label>
        <select name="id_pemesanan" class="form-control" required>
            @foreach ($pemesanan as $p)
                <option value="{{ $p->id_pemesanan }}"
                    {{ $p->id_pemesanan == $detail->id_pemesanan ? 'selected' : '' }}>
                    ID {{ $p->id_pemesanan }} - {{ $p->pendaki->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Pendaki (Anggota)</label>
        <select name="id_pendaki" class="form-control" required>
            @foreach ($pendaki as $pd)
                <option value="{{ $pd->id_pendaki }}"
                    {{ $pd->id_pendaki == $detail->id_pendaki ? 'selected' : '' }}>
                    {{ $pd->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-warning">Update</button>
    <a href="{{ route('detail.index') }}" class="btn btn-secondary">Kembali</a>
</form>

@endsection
