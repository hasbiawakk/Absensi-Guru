<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Absensi Guru')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #111827; /* Darker Slate */
            color: #fff;
            position: fixed;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            background: #1f2937;
        }

        .sidebar nav {
            padding: 1rem;
        }

        .sidebar a {
            color: #9ca3af;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #374151;
            color: #fff;
        }

        .sidebar i {
            width: 20px;
            margin-right: 10px;
        }

        .content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }

        .btn-logout {
            background: rgba(220, 38, 38, 0.1);
            color: #ef4444;
            border: 1px solid rgba(220, 38, 38, 0.2);
            width: 100%;
            margin-top: 2rem;
        }

        .btn-logout:hover {
            background: #dc2626;
            color: #fff;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <div class="sidebar-header">
        <h5 class="mb-0 fw-bold">Absensi Guru</h5>
        <small class="text-muted">Admin Panel</small>
    </div>

    <nav>
        @if(auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="/admin/qr" class="{{ request()->is('admin/qr') ? 'active' : '' }}">
                <i class="fas fa-qrcode"></i> Generate QR
            </a>
            <a href="/admin/rekap" class="{{ request()->is('admin/rekap') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i> Laporan Rekap
            </a>
        @endif

        @if(auth()->user()->role === 'guru')
            <a href="/guru/dashboard"><i class="fas fa-home"></i> Dashboard</a>
            <a href="/absen"><i class="fas fa-user-check"></i> Absen</a>
            <a href="/guru/riwayat"><i class="fas fa-history"></i> Riwayat</a>
        @endif

        <form method="POST" action="/logout">
            @csrf
            <button class="btn btn-logout mt-4" type="submit">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </nav>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>