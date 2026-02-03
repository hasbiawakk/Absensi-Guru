@extends('layouts.app')

@section('title', 'Form Absensi Guru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="mb-4">
            <h2 class="fw-bold">Form Absensi Guru</h2>
            <p class="text-muted">Silahkan isi status kehadiran Anda dengan jujur hari ini.</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4" role="alert" style="border-radius: 12px;">
                <i class="fas fa-exclamation-triangle me-3"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif

        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4 p-md-5">
                <form method="POST" action="/absen" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold text-uppercase small text-muted">Status Kehadiran</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="fas fa-user-check"></i>
                            </span>
                            <select name="status" class="form-select bg-light border-start-0 py-2" required>
                                <option value="" selected disabled>-- Pilih Status --</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="form-label fw-bold text-uppercase small text-muted d-flex justify-content-between">
                            Bukti Pendukung
                            <span class="badge bg-info-subtle text-info fw-normal text-none lowercase">Wajib jika Izin/Sakit</span>
                        </label>
                        <div class="input-group">
                            <input type="file" name="bukti" class="form-control bg-light py-2" id="inputGroupFile02">
                        </div>
                        <div class="form-text text-muted mt-2 small">
                            Format yang didukung: JPG, PNG, atau PDF (Maks. 2MB).
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm rounded-3 transition-all">
                        <i class="fas fa-paper-plane me-2"></i> KIRIM ABSENSI SEKARANG
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="text-muted small">
                <i class="fas fa-question-circle me-1"></i> Mengalami kendala? 
                <a href="#" class="text-primary text-decoration-none">Hubungi Admin IT</a>
            </p>
        </div>
    </div>
</div>

<style>
    /* Tambahan sedikit sentuhan interaksi */
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3) !important;
    }
    .form-select:focus, .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
        border-color: #0d6efd;
    }
</style>
@endsection