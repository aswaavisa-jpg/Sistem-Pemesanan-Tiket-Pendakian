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
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-premium">
    <!-- Tombol Admin Kecil di Pojok Kiri Atas -->
    <a href="/admin" style="
        position: absolute;
        top: 15px;
        left: 13px;
        padding: 4px 8px;
        background-color: #facc15;
        color: #000;
        font-size: 12px;
        border-radius: 4px;
        text-decoration: none;
        z-index: 1000;
    ">
        Admin
    </a>

    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
            Pendakian Merbabu
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto gap-2">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Beranda</a>
                </li>
                

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('detailpendaki.index') }}">Detail Tiket</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kontak') }}">
                        <i class="bi bi-envelope"></i> Kontak
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- ISI HALAMAN -->
<main>
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3 mt-auto">
    <small>© {{ date('Y') }} Sistem Pemesanan Tiket Pendakian</small>
</footer>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.addEventListener('scroll', function () {
        const nav = document.querySelector('.navbar-premium');
        window.scrollY > 80
            ? nav.classList.add('scrolled')
            : nav.classList.remove('scrolled');
    });
</script>

</body>
</html>
