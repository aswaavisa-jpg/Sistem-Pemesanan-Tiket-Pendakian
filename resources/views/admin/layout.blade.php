<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tiket Pendakian</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #4fa3c7 0%, #8fd3ea 100%);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            overflow-y: auto;
            padding: 20px 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        .sidebar-brand {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-brand h4 {
            color: white;
            margin: 0;
            font-weight: 700;
            font-size: 18px;
        }

        .sidebar-brand p {
            color: rgba(255, 255, 255, 0.8);
            margin: 5px 0 0 0;
            font-size: 12px;
        }

        .nav-sidebar {
            list-style: none;
            padding: 0;
        }

        .nav-sidebar .nav-item {
            margin-bottom: 5px;
            padding: 0 15px;
        }

        .nav-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .nav-sidebar .nav-link:hover,
        .nav-sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(5px);
        }

        .nav-sidebar .nav-link i {
            font-size: 18px;
            min-width: 24px;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 20px;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .topbar h2 {
            margin: 0;
            color: #333;
            font-weight: 700;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4fa3c7 0%, #8fd3ea 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
        }

        .logout-btn {
            background: linear-gradient(135deg, #4fa3c7 0%, #3a8ba8 100%);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 163, 199, 0.3);
            color: white;
        }

        /* STAT CARDS */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .stat-icon.users {
            color: #4fa3c7;
        }

        .stat-icon.orders {
            color: #27ae60;
        }

        .stat-icon.transactions {
            color: #f39c12;
        }

        .stat-icon.climbers {
            color: #e74c3c;
        }

        .stat-card h6 {
            color: #666;
            margin: 0;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin: 10px 0 0 0;
        }

        /* TABLE STYLES */
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .table-container h5 {
            margin: 0 0 20px 0;
            color: #333;
            font-weight: 700;
        }

        table {
            margin-bottom: 0;
        }

        table thead {
            background: #f8f9fa;
            border-top: 2px solid #e9ecef;
        }

        table thead th {
            border: none;
            color: #666;
            font-weight: 600;
            font-size: 13px;
            padding: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table tbody td {
            padding: 15px;
            border-color: #e9ecef;
            vertical-align: middle;
            font-size: 14px;
        }

        .badge {
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-admin {
            background: #4fa3c7;
            color: white;
        }

        .badge-pendaki {
            background: #27ae60;
            color: white;
        }

        /* ACTION BUTTONS */
        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
            margin: 2px;
        }

        .btn-edit {
            background: #3498db;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #2980b9;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background: #c0392b;
            color: white;
        }

        .btn-view {
            background: #9b59b6;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
        }

        .btn-view:hover {
            background: #8e44ad;
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            .topbar {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-brand">
            <h4>Admin Panel</h4>
            <p>Tiket Pendakian</p>
        </div>

        <ul class="nav-sidebar">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Kelola Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pendaki.index') }}" class="nav-link {{ request()->routeIs('admin.pendaki.*') ? 'active' : '' }}">
                    <i class="bi bi-person-hiking"></i>
                    <span>Data Pendaki</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pemesanan.index') }}" class="nav-link {{ request()->routeIs('admin.pemesanan.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check"></i>
                    <span>Pemesanan</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.transaksi.index') }}" class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                    <i class="bi bi-credit-card"></i>
                    <span>Transaksi Tiket</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.pembayaran.index') }}" class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i>
                    <span>Verifikasi Pembayaran</span>
                </a>
            </li>

            <li class="nav-item">    
                <a href="{{ route('admin.pendaki.report') }}" class="nav-link {{ request()->routeIs('admin.pendaki.report') ? 'active' : '' }}">
                    <i class="bi bi-graph-up-arrow"></i> <span>Laporan Bulanan</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.chat.index') }}" class="nav-link {{ request()->routeIs('admin.chat.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-dots"></i> 
                    <span>Pusat Bantuan (Chat)</span>
                </a>
            </li>

        </ul>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="main-content">
        {{-- TOPBAR --}}
        <div class="topbar">
            <h2>@yield('page-title', 'Dashboard')</h2>
            <div class="user-info">
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p style="margin: 0; color: #333; font-weight: 600; font-size: 14px;">
                        {{ Auth::user()->name }}
                    </p>
                    <p style="margin: 0; color: #999; font-size: 12px;">
                        <span class="badge {{ Auth::user()->role === 'Admin' ? 'badge-admin' : 'badge-pendaki' }}">
                            {{ Auth::user()->role }}
                        </span>
                    </p>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-octagon-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- CONTENT --}}
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Simple active menu highlighting
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>

</body>
</html>
