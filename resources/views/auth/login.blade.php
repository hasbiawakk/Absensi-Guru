<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Absensi Guru</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Modern Gradient */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            background: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #4e54c8;
            font-size: 2rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }

        .btn-login {
            background: linear-gradient(to right, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-login:hover {
            opacity: 0.9;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .login-footer {
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="login-card">
        <div class="text-center">
            <div class="brand-logo shadow-sm">
                <i class="fas fa-user-check"></i>
            </div>
            <h3 class="fw-bold text-dark">Selamat Datang</h3>
            <p class="text-muted small mb-4">Silahkan masuk ke akun Anda</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 small border-0" style="border-radius: 10px;">
                <i class="fas fa-exclamation-circle me-2"></i> Email atau password salah!
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold text-uppercase text-muted">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="nama@sekolah.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between">
                    <label class="form-label small fw-bold text-uppercase text-muted">Password</label>
                    <a href="#" class="text-decoration-none small" style="color: #667eea;">Lupa Password?</a>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0 text-muted">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-login w-100 mb-3 text-white">
                LOGIN SEKARANG
            </button>
        </form>

        <div class="login-footer">
            &copy; 2026 Sistem Absensi Guru <br>
            <span class="fw-medium">Versi 2.0.1</span>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>   