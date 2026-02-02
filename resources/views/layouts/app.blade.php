<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <style>
        body { margin:0; font-family: Arial }
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #1f2937;
            color: white;
            float: left;
            padding: 20px;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        a { color: white; text-decoration: none; display: block; margin: 10px 0; }
    </style>
</head>
<body>

<div class="sidebar">
    <h3>Absensi Guru</h3>

    @if(auth()->user()->role === 'admin')
        <a href="/admin/dashboard">Dashboard</a>
        <a href="#">Generate QR</a>
        <a href="#">Laporan</a>
    @endif

    @if(auth()->user()->role === 'guru')
        <a href="/guru/dashboard">Dashboard</a>
        <a href="#">Absen</a>
        <a href="#">Riwayat</a>
    @endif

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
