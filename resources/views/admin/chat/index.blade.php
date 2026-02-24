@extends('admin.layout')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-0">Pusat Bantuan (Chat)</h2>
            <p class="text-muted">Kelola pertanyaan dari pengunjung dan pengguna.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-bottom">
            <h6 class="mb-0 fw-bold">Daftar Percakapan</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Pengguna</th>
                        <th>Pesan Terakhir</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    @php $lastChat = $user->chats->first(); @endphp
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <div class="small text-muted">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 300px;">
                                {{ $lastChat->message }}
                            </div>
                        </td>
                        <td>
                            <div class="small text-muted">
                                {{ $lastChat->created_at->diffForHumans() }}
                            </div>
                        </td>
                        <td>
                            @php 
                                $unread = $user->chats->where('is_from_admin', false)->where('is_read', false)->count();
                            @endphp
                            @if($unread > 0)
                                <span class="badge bg-danger rounded-pill">{{ $unread }} Pesan Baru</span>
                            @else
                                <span class="badge bg-light text-muted border rounded-pill">Dibaca</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.chat.show', $user->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                <i class="bi bi-chat-dots me-1"></i> Balas
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-chat-left-text text-muted display-4 d-block mb-3"></i>
                            <div class="text-muted">Belum ada percakapan masuk.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
