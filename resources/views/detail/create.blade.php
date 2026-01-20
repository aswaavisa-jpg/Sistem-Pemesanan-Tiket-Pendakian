@extends('layout')

@section('content')

<h2 class="mb-3">Tambah Detail Pendaki</h2>

<form action="{{ route('detail.store') }}" method="POST">
    @csrf

    {{-- PEMESANAN --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Pemesanan</label>
    <select name="pemesanan_id"
            class="form-control"
            required>
        <option value="">-- Pilih Pemesanan --</option>

        @foreach ($pemesanans as $p)
            <option value="{{ $p->id }}">
                {{ $p->nama }} | {{ $p->nik }}
            </option>
        @endforeach
    </select>
</div>

{{-- PENDaki --}}
<div class="mb-4">
    <label class="form-label fw-semibold">Nama Pendaki</label>
    <select name="pendaki_id"
            class="form-control"
            required>
        <option value="">-- Pilih Pendaki --</option>

        @foreach ($pendakis as $pd)
            <option value="{{ $pd->id }}">
                {{ $pd->nama }} | {{ $pd->nik }}
            </option>
        @endforeach
    </select>
</div>

</form>

@endsection
