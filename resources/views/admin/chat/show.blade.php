@extends('admin.layout')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="mb-4">
        <a href="{{ route('admin.chat.index') }}" class="btn btn-link text-decoration-none p-0 mb-2">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Chat
        </a>
        <h2 class="fw-bold">Percakapan dengan {{ $user->name }}</h2>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="height: 600px; display: flex; flex-direction: column;">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="bg-success rounded-circle" style="width: 10px; height: 10px;"></div>
                        <span class="fw-bold">Online</span>
                    </div>
                </div>

                <div class="card-body p-4 bg-light" id="admin-chat-messages" style="flex: 1; overflow-y: auto;">
                    @foreach($messages as $msg)
                        <div class="mb-3 d-flex flex-column {{ $msg->is_from_admin ? 'align-items-end' : 'align-items-start' }}">
                            <div class="p-3 rounded-4 shadow-sm {{ $msg->is_from_admin ? 'bg-primary text-white' : 'bg-white text-dark' }}" style="max-width: 75%;">
                                {{ $msg->message }}
                            </div>
                            <small class="text-muted mt-1" style="font-size: 11px;">
                                {{ $msg->created_at->format('H:i') }} · {{ $msg->is_from_admin ? 'Admin' : $user->name }}
                            </small>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer bg-white border-0 p-4">
                    <form action="{{ route('admin.chat.reply', $user->id) }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="message" class="form-control rounded-pill-start border-light py-3 px-4" placeholder="Tulis balasan anda..." required autocomplete="off">
                            <button class="btn btn-primary rounded-pill-end px-4" type="submit">
                                <i class="bi bi-send-fill me-1"></i> Balas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-3">Informasi Pengguna</h6>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 24px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5">{{ $user->name }}</div>
                        <div class="text-muted small">{{ $user->email }}</div>
                    </div>
                </div>
                <hr class="text-muted opacity-25">
                <div class="mb-3">
                    <label class="small text-muted d-block">Role</label>
                    <span class="badge bg-secondary rounded-pill px-3">{{ $user->role }}</span>
                </div>
                <div class="mb-3">
                    <label class="small text-muted d-block">Daftar Sejak</label>
                    <div class="fw-bold">{{ $user->created_at->format('d M Y') }}</div>
                </div>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 mt-2">
                    Lihat Profil Lengkap
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('admin-chat-messages');
        container.scrollTop = container.scrollHeight;
    });
</script>
@endsection
