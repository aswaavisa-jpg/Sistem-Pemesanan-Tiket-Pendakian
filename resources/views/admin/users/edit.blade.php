@extends('admin.layout')

@section('page-title', 'Edit User')

@section('content')

<div class="table-container">
    <h5 style="margin-bottom: 30px;">
        <i class="bi bi-pencil-square"></i> Edit User: {{ $user->name }}
    </h5>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                        value="{{ old('name', $user->name) }}"
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
                        value="{{ old('email', $user->email) }}"
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
                        <i class="bi bi-key"></i> Password Baru (Kosongkan jika tidak ingin mengubah)
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password baru (minimal 6 karakter)">
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
                        placeholder="Konfirmasi password baru">
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
                        <option value="Admin" {{ old('role', $user->role) === 'Admin' ? 'selected' : '' }}>
                            <i class="bi bi-shield-lock"></i> Admin
                        </option>
                        <option value="Pendaki" {{ old('role', $user->role) === 'Pendaki' ? 'selected' : '' }}>
                            <i class="bi bi-person-hiking"></i> Pendaki
                        </option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">
                        <i class="bi bi-check-circle"></i> Status Verifikasi
                    </label>
                    <div class="form-check form-switch" style="padding: 10px 15px; background: #f8f9fa; border-radius: 6px; border: 1px solid #e9ecef;">
                        <input class="form-check-input" type="checkbox" id="is_verified" name="is_verified" value="1" {{ $user->email_verified_at ? 'checked' : '' }} style="margin-left: 0; margin-right: 10px;">
                        <label class="form-check-label" for="is_verified" style="cursor: pointer;">
                            @if($user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i> Verified
                                </span>
                                <small class="text-muted d-block mt-1">Sejak: {{ $user->email_verified_at->format('d M Y H:i') }}</small>
                            @else
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-exclamation-circle"></i> Belum Verified
                                </span>
                                <small class="text-muted d-block mt-1">Centang untuk memverifikasi manual</small>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #4fa3c7 0%, #3a8ba8 100%); color: white; padding: 10px 25px; border: none; border-radius: 6px; font-weight: 600;">
                <i class="bi bi-check-circle"></i> Update
            </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm" style="background: #e9ecef; color: #333; padding: 10px 25px; border: none; border-radius: 6px; font-weight: 600; text-decoration: none;">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

@endsection
