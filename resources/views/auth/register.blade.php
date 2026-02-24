<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Gunung Merbabu</title>
    
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
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-y: auto; /* Allow scroll if content is long */
            padding: 20px 0;
        }

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
            position: fixed; /* Fixed background */
        }

        .login-container {
            width: 100%;
            max-width: 500px; /* Slightly wider for register */
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
            backdrop-filter: blur(10px);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #0f172a, #1e3a5f);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .login-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3b82f6, #2563eb); /* Blue for Register */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 36px;
            color: #fff;
            box-shadow: 0 10px 40px rgba(59, 130, 246, 0.4);
            position: relative;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .login-header h2 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 24px;
            color: #fff;
            position: relative;
        }

        .login-header p {
            margin: 0;
            font-size: 14px;
            color: #94a3b8;
            position: relative;
        }

        .login-body {
            padding: 30px 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .form-label i {
            color: #3b82f6; /* Blue icon */
            font-size: 16px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
            background: #fff;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
        }

        .invalid-feedback {
            display: block;
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .login-footer {
            text-align: center;
            padding: 20px 40px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .login-footer a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .login-footer a:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        /* Decorative elements */
        .decoration {
            position: fixed;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.1);
            pointer-events: none;
        }

        .decoration-1 {
            width: 300px;
            height: 300px;
            top: -50px;
            right: -50px;
        }

        .decoration-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
        }
    </style>
</head>
<body>

<div class="decoration decoration-1"></div>
<div class="decoration decoration-2"></div>

<div class="login-container">
    <div class="login-card">
        
        {{-- Header --}}
        <div class="login-header">
            <div class="login-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <h2>Buat Akun Baru</h2>
            <p>Bergabung komunitas pendaki Merbabu</p>
        </div>

        {{-- Body --}}
        <div class="login-body">
            
            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- Nama --}}
                <div class="form-group">
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
                        required 
                        autofocus>
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="bi bi-envelope"></i> Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Contoh: user@email.com"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="bi bi-key"></i> Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Buat password (min 8 karakter)"
                        required>
                    @error('password')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">
                        <i class="bi bi-check-circle"></i> Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Ulangi password"
                        required>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus-fill"></i> Daftar Sekarang
                </button>

            </form>

        </div>

        {{-- Footer --}}
        <div class="login-footer">
            <span class="text-muted small">Sudah punya akun? </span>
            <a href="{{ route('login') }}">
                Masuk disini
            </a>
        </div>

    </div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
