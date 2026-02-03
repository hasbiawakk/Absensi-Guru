@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Dashboard Overview</h2>
        <p class="text-muted">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong></p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3 text-primary">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Total Guru</h6>
                        <h3 class="fw-bold mb-0">10</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3 text-success">
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Absensi Hari Ini</h6>
                        <h3 class="fw-bold mb-0">7</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-radius: 15px;">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3 text-warning">
                        <i class="fas fa-server fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Status Sistem</h6>
                        <span class="badge bg-success">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-5" style="border-radius: 15px;">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Menu Cepat</h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="/admin/qr" class="btn btn-outline-dark w-100 p-3 text-start d-flex align-items-center justify-content-between border-light-subtle shadow-sm bg-light-subtle">
                        <span><i class="fas fa-qrcode me-2 text-primary"></i> Generate QR</span>
                        <i class="fas fa-chevron-right opacity-50"></i>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/admin/rekap" class="btn btn-outline-dark w-100 p-3 text-start d-flex align-items-center justify-content-between border-light-subtle shadow-sm bg-light-subtle">
                        <span><i class="fas fa-file-alt me-2 text-success"></i> Laporan Absensi</span>
                        <i class="fas fa-chevron-right opacity-50"></i>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn btn-outline-dark w-100 p-3 text-start d-flex align-items-center justify-content-between border-light-subtle shadow-sm bg-light-subtle">
                        <span><i class="fas fa-user-cog me-2 text-info"></i> Kelola Guru</span>
                        <i class="fas fa-chevron-right opacity-50"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection