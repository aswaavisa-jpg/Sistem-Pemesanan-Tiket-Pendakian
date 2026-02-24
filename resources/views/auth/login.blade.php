<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gunung Merbabu</title>
    
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
            /* Navy Gradient Background */
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #334155;
            position: relative;
            overflow: hidden;
        }

         /* Background Pattern Overlay */
         body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff08" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
            pointer-events: none;
        }

        .login-container {
            width: 100%;
            max-width: 500px; /* Narrower Container */
            padding: 20px;
            position: relative;
            z-index: 2;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            padding: 40px;
            width: 100%;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-weight: 700;
            font-size: 28px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 15px;
        }

        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .form-label i {
            color: #1e3a5f; /* Adjusted to match theme */
            font-size: 16px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.2s;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: #1e3a5f;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(30, 58, 95, 0.1);
            outline: none;
        }

        .form-check-input {
            cursor: pointer;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
        }

        .form-check-input:checked {
            background-color: #1e3a5f;
            border-color: #1e3a5f;
        }

        .form-check-label {
            cursor: pointer;
            font-size: 14px;
            color: #475569;
            margin-left: 8px;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e3a5f, #0f172a);
            color: white;
            font-weight: 600;
            padding: 14px;
            border-radius: 10px;
            border: none;
            width: 100%;
            font-size: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.4);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #15803d;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }

        .login-footer a {
            color: #475569;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .login-footer a:hover {
            color: #1e3a5f;
        }
        
        .register-link {
            text-decoration: none; 
            font-weight: 600; 
            color: #1e3a5f;
            font-size: 14px;
        }
        
        .register-link:hover {
            text-decoration: underline;
        }

        /* Responsive Tweaks */
        @media (max-width: 576px) {
            .login-card {
                padding: 30px 25px;
            }
            
            .login-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        
        <div class="login-header">
            <h2>Selamat Datang</h2>
            <p>Silakan masuk untuk melanjutkan reservasi pendakian</p>
        </div>

        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-exclamation-triangle-fill mt-1"></i>
                    <div>
                        <strong>Login Gagal!</strong>
                        <ul class="mb-0 ps-3 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success mb-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label" for="email">
                    <i class="bi bi-envelope"></i> Email
                </label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required 
                    autofocus>
                @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label" for="password">
                    <i class="bi bi-key"></i> Password
                </label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="********"
                    required>
                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="remember" 
                        name="remember">
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>
                
                <a href="{{ route('register') }}" class="register-link">
                    Belum punya akun? Daftar
                </a>
            </div>

            <button type="submit" class="btn-login">
                Masuk Sekarang <i class="bi bi-box-arrow-in-right"></i>
            </button>
        </form>

        <div class="login-footer">
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-arrow-left"></i> Kembali ke Halaman Utama
            </a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
