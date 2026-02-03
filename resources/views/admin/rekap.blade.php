@extends('layouts.app')

@section('title', 'Rekap Absensi Guru')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="fw-bold">Rekap Absensi Guru</h2>
        <p class="text-muted">Pantau kehadiran guru secara real-time berdasarkan tanggal.</p>
    </div>
    <button class="btn btn-outline-success shadow-sm">
        <i class="fas fa-file-excel me-2"></i> Export Excel
    </button>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
    <div class="card-body p-4">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold small text-uppercase">Pilih Tanggal</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-day text-muted"></i></span>
                    <input type="date" name="tanggal" class="form-control bg-light border-start-0" value="{{ $tanggal }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
                    <i class="fas fa-filter me-2"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-bold text-muted" width="50">No</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Nama Guru</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Tanggal</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-center">Jam Absen</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $a)
                    <tr>
                        <td class="px-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                    {{ strtoupper(substr($a->user->name, 0, 2)) }}
                                </div>
                                <span class="fw-semibold text-slate-700">{{ $a->user->name }}</span>
                            </div>
                        </td>
                        <td class="text-muted italic">{{ \Carbon\Carbon::parse($a->tanggal)->format('d M Y') }}</td>
                        <td class="text-center font-monospace">
                            <span class="badge bg-light text-dark border fw-normal">{{ $a->jam_absen }}</span>
                        </td>
                        <td class="text-center">
                            @php
                                $statusClass = [
                                    'masuk' => 'bg-success',
                                    'izin'  => 'bg-warning text-dark',
                                    'sakit' => 'bg-info text-white',
                                    'alpa'  => 'bg-danger'
                                ][strtolower($a->status)] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $statusClass }} rounded-pill px-3 py-2 text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                {{ $a->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted italic">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-25"></i>
                            Tidak ada data absensi untuk tanggal ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection