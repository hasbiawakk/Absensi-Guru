<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\QrToken;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AttendanceRecapController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/guru/dashboard');
    }

    return redirect('/login');
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', fn () => view('admin.dashboard'));

    // Generate QR harian
    Route::get('/admin/qr', function () {
        $today = Carbon::today();

        $qr = QrToken::firstOrCreate(
            ['tanggal' => $today],
            ['token' => Str::random(40)]
        );

        return view('admin.qr', compact('qr'));
    })->name('admin.qr');

    Route::get('/admin/rekap', [AttendanceRecapController::class, 'index'])
        ->name('admin.rekap');
});

/*
|--------------------------------------------------------------------------
| QR SCAN (PUBLIC ENTRY)
|--------------------------------------------------------------------------
*/
Route::get('/absen/{token}', [AttendanceController::class, 'scan'])
    ->name('absen.scan');

/*
|--------------------------------------------------------------------------
| GURU (LOGIN BIASA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/guru/dashboard', [AttendanceController::class, 'dashboard'])
    ->name('guru.dashboard')
    ->middleware(['auth', 'role:guru']);

    Route::get('/guru/absensi', [AttendanceController::class, 'index'])
        ->name('guru.absensi');

    Route::get('/guru/riwayat', [AttendanceController::class, 'riwayat'])
        ->name('guru.riwayat');

    // FORM ABSENSI (GET)
    Route::get('/absen', [AttendanceController::class, 'index'])
        ->name('absen.form');

    // SIMPAN ABSENSI (POST)
    Route::post('/absen', [AttendanceController::class, 'store'])
        ->name('absen.store');
});


