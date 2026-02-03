@extends('layouts.app')

@section('title', 'Generate QR Absensi')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold">Generate QR Absensi</h2>
        <p class="text-muted">Gunakan panel ini untuk mencetak atau menampilkan kode QR harian.</p>
    </div>

    <div class="row">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0"><i class="fas fa-cog me-2 text-primary"></i>Konfigurasi QR</h5>
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-uppercase">Tanggal Presensi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                                <input type="date" class="form-control bg-light border-start-0" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase">Status Sesi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-clock text-muted"></i></span>
                                <select class="form-select bg-light border-start-0">
                                    <option selected>Masuk</option>
                                    <option>Pulang</option>
                                    <option>Izin/Sakit</option>
                                </select>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary w-100 py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            <i class="fas fa-sync-alt me-2"></i> Update QR Code
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="alert alert-info border-0 shadow-sm mt-4" style="border-radius: 12px;">
                <small><i class="fas fa-info-circle me-2"></i> QR Code akan otomatis diperbarui berdasarkan parameter yang Anda pilih di atas.</small>
            </div>
        </div>

        <div class="col-md-6 offset-md-1">
            <div class="card border-0 shadow-sm text-center p-5" style="border-radius: 20px; background: linear-gradient(145deg, #ffffff, #f0f4f8);">
                <div class="qr-container bg-white p-4 d-inline-block shadow-sm mb-4" style="border-radius: 20px; border: 1px solid #e2e8f0;">
                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->color(31, 41, 55)->margin(1)->generate(route('absen')) !!}
                </div>
                
                <h4 class="fw-bold mb-1">Siap Scan!</h4>
                <p class="text-muted px-4">Arahkan kamera smartphone atau aplikasi scanner pada barcode di atas untuk melakukan absensi.</p>
                
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <button class="btn btn-light btn-sm border shadow-sm px-3">
                        <i class="fas fa-print me-1"></i> Cetak QR
                    </button>
                    <button class="btn btn-light btn-sm border shadow-sm px-3">
                        <i class="fas fa-download me-1"></i> Unduh PNG
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection