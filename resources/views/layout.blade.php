<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pemesanan Tiket Pendakian</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 80px; /* OFFSET NAVBAR FIXED */
        }

        main {
            flex: 1;
        }

        /* NAVBAR */
        .navbar-premium {
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(10px);
            transition: 0.4s;
        }

        .navbar-premium.scrolled {
            background: #0f172a;
            box-shadow: 0 6px 20px rgba(0,0,0,.3);
        }

        .navbar-premium .nav-link {
            color: #fff !important;
            position: relative;
        }

        .navbar-premium .nav-link::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            background: #facc15;
            left: 0;
            bottom: 0;
            transition: .3s;
        }

        .navbar-premium .nav-link:hover::after {
            width: 100%;
        }

        /* ADMIN & LOGOUT */
        .nav-action .btn {
            font-size: 13px;
            padding: 5px 14px;
            border-radius: 20px;
            font-weight: 600;
        }

        /* Centering Menu for Guest */
        @media (min-width: 992px) {
            .guest-nav-center {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }

        /* FLOATING ALERTS */
        .floating-alert-container {
            position: fixed;
            top: 90px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1060;
            width: 90%;
            max-width: 600px;
            pointer-events: none;
        }
        .floating-alert-container .alert {
            pointer-events: auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
            border: none !important;
            animation: slideDownAlert 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes slideDownAlert {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* FLOATING CHAT WIDGET */
        #chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1050;
        }

        #chat-button {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 10px 25px rgba(29, 78, 216, 0.4);
            cursor: pointer;
            transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
        }

        #chat-button:hover {
            transform: scale(1.1) rotate(5deg);
        }

        #chat-window {
            position: absolute;
            bottom: 80px;
            right: 0;
            width: 350px;
            height: 480px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.15);
            display: none;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
            animation: slideInChat 0.3s ease-out;
        }

        @keyframes slideInChat {
            from { opacity: 0; transform: translateY(20px) scale(0.9); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .chat-header {
            background: #0f172a;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header h6 { margin: 0; font-weight: 600; }

        #chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .message {
            max-width: 80%;
            padding: 10px 14px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.4;
            position: relative;
        }

        .message.user {
            align-self: flex-end;
            background: #3b82f6;
            color: white;
            border-bottom-right-radius: 2px;
        }

        .message.admin {
            align-self: flex-start;
            background: white;
            color: #1e293b;
            border-bottom-left-radius: 2px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .chat-footer {
            padding: 15px;
            background: white;
            border-top: 1px solid #f1f5f9;
        }

        .chat-input-group {
            display: flex;
            gap: 8px;
        }

        .chat-input {
            flex: 1;
            border: 1px solid #e2e8f0;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
        }

        .chat-input:focus { border-color: #3b82f6; }

        .btn-send {
            background: #3b82f6;
            color: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
        }

        .btn-send:hover { background: #1d4ed8; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-premium">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Pendakian Merbabu
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <!-- MENU -->
            <ul class="navbar-nav {{ Auth::check() ? 'flex-grow-1' : 'mx-auto' }} justify-content-center gap-2 text-center {{ Auth::check() ? '' : 'guest-nav-center' }}">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('detailpendaki.index') }}">Detail Pemesanan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gunung.index') }}">Gunung</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('penjualantiket.index') }}">
                        Tiket Saya
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontak') }}">Kontak</a>
                </li>
            </ul>

            <!-- ADMIN & AUTH -->
            <div class="nav-action d-flex align-items-center justify-content-center justify-content-lg-end gap-2">
                @auth
                    <div class="d-flex align-items-center me-2 py-1 px-3 rounded-pill bg-light bg-opacity-10 border border-light border-opacity-25">
                        <i class="bi bi-person-circle text-warning me-2"></i>
                        <span class="text-white small fw-bold">{{ Auth::user()->name }}</span>
                    </div>

                    @if(Auth::user()->role === 'Admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-speedometer2"></i> Admin
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" style="font-weight: 600;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                @endauth
            </div>

        </div>
    </div>
</nav>

<!-- FLOATING NOTIFICATIONS -->
<div class="floating-alert-container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show text-dark" role="alert" style="background-color: #e0f2fe; border-left: 4px solid #0ea5e9 !important;">
            <i class="bi bi-info-circle-fill me-2 text-primary"></i> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<!-- ISI HALAMAN -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>© {{ date('Y') }} Sistem Pemesanan Tiket Pendakian</small>
</footer>

<!-- CHAT WIDGET -->
@auth
<div id="chat-widget">
    <div id="chat-window">
        <div class="chat-header">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-chat-dots-fill text-warning"></i>
                <h6>Pusat Bantuan</h6>
            </div>
            <button class="btn-close btn-close-white small" onclick="toggleChat()"></button>
        </div>
        <div id="chat-messages">
            <!-- Pesan akan dimuat di sini via JS -->
            <div class="text-center py-5 text-muted small">
                <i class="bi bi-info-circle me-1"></i> Memuat percakapan...
            </div>
        </div>
        <div class="chat-footer">
            <form id="chat-form" onsubmit="handleChatSubmit(event)">
                <div class="chat-input-group">
                    <input type="text" id="chat-input" class="chat-input" placeholder="Tulis pertanyaan..." required autocomplete="off">
                    <button type="submit" class="btn-send">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <button id="chat-button" onclick="toggleChat()" title="Tanya Admin">
        <i class="bi bi-chat-text-fill"></i>
    </button>
</div>
@endauth

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.addEventListener('scroll', function () {
        const nav = document.querySelector('.navbar-premium');
        window.scrollY > 80
            ? nav.classList.add('scrolled')
            : nav.classList.remove('scrolled');
    });

    // Auto-close alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.floating-alert-container .alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // CHAT LOGIC
    @auth
    let chatOpen = false;
    const chatWindow = document.getElementById('chat-window');
    const messageContainer = document.getElementById('chat-messages');

    function toggleChat() {
        chatOpen = !chatOpen;
        chatWindow.style.display = chatOpen ? 'flex' : 'none';
        if (chatOpen) {
            loadMessages();
            scrollToBottom();
        }
    }

    // (no back-to-top script — footer kept simple)

    async function loadMessages() {
        try {
            const response = await fetch("{{ route('chat.messages', [], false) }}");
            
            if (!response.ok) {
                messageContainer.innerHTML = `<div class="text-center py-5 text-danger small"><i class="bi bi-exclamation-triangle"></i> Error ${response.status}: Gagal memuat.</div>`;
                return;
            }

            const messages = await response.json();
            
            if (messages.length === 0) {
                messageContainer.innerHTML = '<div class="text-center py-5 text-muted small">Halo! Ada yang bisa kami bantu? Silakan tulis pertanyaan Anda di bawah.</div>';
                return;
            }

            messageContainer.innerHTML = messages.map(msg => {
                // Perbaikan deteksi admin: Laravel JSON bisa kirim boolean, string "1", atau integer 1
                const isAdmin = (msg.is_from_admin == 1 || msg.is_from_admin === true);
                
                // Perbaikan format waktu: pastikan created_at ada
                let timeStr = "";
                try {
                    timeStr = msg.created_at ? new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) : "";
                } catch(e) { timeStr = "..."; }

                return `
                    <div class="message ${isAdmin ? 'admin' : 'user'}">
                        ${msg.message}
                        <div style="font-size: 9px; opacity: 0.6; text-align: right; margin-top: 4px;">
                            ${timeStr}
                        </div>
                    </div>
                `;
            }).join('');
            
            scrollToBottom();
        } catch (error) {
            console.error("Chat Error:", error);
            messageContainer.innerHTML = '<div class="text-center py-5 text-danger small"><i class="bi bi-wifi-off"></i> Koneksi ke Chat Terputus.<br>Refresh halaman atau cek server.</div>';
        }
    }

    async function handleChatSubmit(e) {
        e.preventDefault();
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        if (!message) return;

        // UI Feedback: optimistically add message or show loading
        const originalValue = message;
        input.value = '';
        input.disabled = true;

        try {
            const response = await fetch("{{ route('chat.send', [], false) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message })
            });

            if (response.ok) {
                await loadMessages();
            } else {
                const errData = await response.json();
                alert("Gagal mengirim: " + (errData.message || "Error tidak diketahui"));
                input.value = originalValue; // Kembalikan teks kalau gagal
            }
        } catch (error) {
            console.error("Gagal mengirim pesan:", error);
            alert("Koneksi terputus. Pastikan terminal/Git Bash masih jalan.");
            input.value = originalValue;
        } finally {
            input.disabled = false;
            input.focus();
        }
    }

    function scrollToBottom() {
        messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    // Polling pesan setiap 5 detik jika chat terbuka
    setInterval(() => {
        if (chatOpen) loadMessages();
    }, 5000);
    @endauth
</script>

</body>
</html>
