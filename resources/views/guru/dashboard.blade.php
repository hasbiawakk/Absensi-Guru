@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h2 class="fw-bold">Dashboard Guru</h2>
    <p class="text-muted mb-0">
        Selamat datang,
        <span class="fw-semibold text-primary">{{ auth()->user()->name }}</span>
    </p>
</div>

{{-- STATUS HARI INI (PRIORITAS UTAMA) --}}
<div class="card border-0 shadow-sm rounded-4 mb-4
    @if(!$attendanceToday) border-start border-danger border-4
    @elseif($attendanceToday->jam_masuk && !$attendanceToday->jam_pulang) border-start border-warning border-4
    @else border-start border-success border-4 @endif
">
    <div class="card-body p-4 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-uppercase small text-muted fw-bold mb-1">
                Status Absensi Hari Ini
            </h6>

            @if (!$attendanceToday)
                <h4 class="fw-bold text-danger mb-1">Belum Absen</h4>
                <small class="text-muted">Silakan scan QR untuk absen masuk</small>
            @elseif ($attendanceToday->jam_masuk && !$attendanceToday->jam_pulang)
                <h4 class="fw-bold text-warning mb-1">Sudah Masuk</h4>
                <small class="text-muted">
                    Jam masuk:
                    {{ \Carbon\Carbon::parse($attendanceToday->jam_masuk)->format('H:i') }}
                </small>
            @else
                <h4 class="fw-bold text-success mb-1">Absensi Selesai</h4>
                <small class="text-muted">
                    Pulang:
                    {{ \Carbon\Carbon::parse($attendanceToday->jam_pulang)->format('H:i') }}
                </small>
            @endif
        </div>

        {{-- CTA --}}
        @if (!$attendanceToday || !$attendanceToday->jam_pulang)
            <form action="{{ route('absen.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success w-100">
            Absen Sekarang
        </button>
    </form>
        @endif
    </div>
</div>

{{-- STATISTIK --}}
<div class="row g-4 mb-4">

    {{-- HADIR --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3">
                    <i class="fas fa-user-check fa-lg"></i>
                </div>
                <div>
                    <div class="small text-muted text-uppercase fw-bold">
                        Hadir
                    </div>
                    <h3 class="fw-bold mb-0">{{ $hadirBulanIni }}</h3>
                    <small class="text-muted">Bulan ini</small>
                </div>
            </div>
        </div>
    </div>

    {{-- IZIN --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                    <i class="fas fa-envelope-open-text fa-lg"></i>
                </div>
                <div>
                    <div class="small text-muted text-uppercase fw-bold">
                        Izin / Sakit
                    </div>
                    <h3 class="fw-bold mb-0">{{ $izinSakit }}</h3>
                    <small class="text-muted">Hari terpakai</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ALPHA --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-3 me-3">
                    <i class="fas fa-user-times fa-lg"></i>
                </div>
                <div>
                    <div class="small text-muted text-uppercase fw-bold">
                        Alpha
                    </div>
                    <h3 class="fw-bold mb-0">{{ $alpha }}</h3>
                    <small class="text-muted">Bulan ini</small>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- AKSI CEPAT --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-3">
            <i class="fas fa-bolt text-primary me-2"></i>Aksi Cepat
        </h5>

        <div class="row g-3">

            <div class="col-md-6">
                <a href="/absen" class="btn btn-light w-100 p-4 rounded-4 shadow-sm text-start">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-3 p-3 me-3">
                            <i class="fas fa-camera fa-lg"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Scan QR Absensi</div>
                            <small class="text-muted">
                                @if (!$attendanceToday)
                                    Absen masuk
                                @elseif (!$attendanceToday->jam_pulang)
                                    Absen pulang
                                @else
                                    Absensi selesai
                                @endif
                            </small>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('guru.riwayat') }}"
                   class="btn btn-light w-100 p-4 rounded-4 shadow-sm text-start">
                    <div class="d-flex align-items-center">
                        <div class="bg-secondary text-white rounded-3 p-3 me-3">
                            <i class="fas fa-history fa-lg"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Riwayat Absensi</div>
                            <small class="text-muted">Lihat data kehadiran Anda</small>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
