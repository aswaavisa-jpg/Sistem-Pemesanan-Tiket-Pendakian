@extends('admin.layout')

@section('page-title', 'Kelola Users')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h5 style="margin: 0; color: #333; font-weight: 700;">
        <i class="bi bi-people"></i> Daftar Users
    </h5>
    <a href="{{ route('admin.users.create') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #4fa3c7 0%, #3a8ba8 100%); color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600;">
        <i class="bi bi-plus-lg"></i> Tambah User
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px;">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-container">
    @if($users->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'Admin' ? 'badge-admin' : 'badge-pendaki' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">Verified</span>
                                @else
                                    <span class="badge bg-warning text-dark">Unverified</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            {{ $users->links() }}
        </div>
    @else
        <p class="text-muted text-center" style="padding: 40px 0;">
            <i class="bi bi-inbox" style="font-size: 32px;"></i><br>
            Belum ada user terdaftar
        </p>
    @endif
</div>

@endsection
