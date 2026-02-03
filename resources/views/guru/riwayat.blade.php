@extends('layouts.app')

@section('title', 'Riwayat Absensi')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="fw-bold text-dark">Riwayat Absensi Saya</h2>
        <p class="text-muted small">Pantau catatan kehadiran Anda dari waktu ke waktu.</p>
    </div>
    <div class="bg-white p-2 px-3 rounded-pill shadow-sm border">
        <span class="text-muted small fw-medium">Bulan ini: </span>
        <span class="fw-bold text-primary">{{ $riwayat->count() }} Kali Hadir</span>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-bold text-muted" width="50">No</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted">Tanggal</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-center">Jam Absen</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-center">Status</th>
                    <th class="py-3 text-uppercase small fw-bold text-muted text-center">Bukti</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $item)
                    <tr>
                        <td class="px-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-light p-2 rounded-3 me-3">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <span class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border fw-normal px-3 py-2">
                                <i class="far fa-clock me-1 text-muted"></i> {{ $item->jam_absen }}
                            </span>
                        </td>
                        <td class="text-center">
                            @php
                                $status = strtolower($item->status);
                                $badgeClass = match($status) {
                                    'hadir' => 'bg-success',
                                    'izin' => 'bg-warning text-dark',
                                    'sakit' => 'bg-info',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($item->bukti)
                                <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                            @else
                                <span class="text-muted small italic">- Tanpa Bukti -</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="py-4">
                                <i class="fas fa-clipboard-list fa-3x text-light mb-3"></i>
                                <p class="text-muted mb-0">Belum ada data absensi tercatat.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    <div class="alert alert-light border shadow-sm small" style="border-radius: 12px;">
        <i class="fas fa-info-circle me-2 text-primary"></i> 
        Klik tombol <strong>Lihat</strong> pada kolom bukti untuk membuka dokumen atau foto pendukung yang Anda unggah.
    </div>
</div>
@endsection