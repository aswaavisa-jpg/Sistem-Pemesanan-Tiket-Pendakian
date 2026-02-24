@extends('admin.layout')

@section('page-title', 'Tambah User Baru')

@section('content')

<div class="table-container">
    <h5 style="margin-bottom: 30px;">
        <i class="bi bi-person-plus"></i> Form Tambah User Baru
    </h5>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="name">
                        <i class="bi bi-person"></i> Nama Lengkap
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        placeholder="Masukkan nama lengkap"
                        value="{{ old('name') }}"
                        required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="email">
                        <i class="bi bi-envelope"></i> Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Masukkan email"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="password">
                        <i class="bi bi-key"></i> Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password (minimal 6 karakter)"
                        required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">
                        <i class="bi bi-key"></i> Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Konfirmasi password"
                        required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="role">
                        <i class="bi bi-shield-check"></i> Role
                    </label>
                    <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>
                            <i class="bi bi-shield-lock"></i> Admin
                        </option>
                        <option value="Pendaki" {{ old('role') === 'Pendaki' ? 'selected' : '' }}>
                            <i class="bi bi-person-hiking"></i> Pendaki
                        </option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #4fa3c7 0%, #3a8ba8 100%); color: white; padding: 10px 25px; border: none; border-radius: 6px; font-weight: 600;">
                <i class="bi bi-check-circle"></i> Simpan
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm" style="background: #e9ecef; color: #333; padding: 10px 25px; border: none; border-radius: 6px; font-weight: 600; text-decoration: none;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

@endsection
