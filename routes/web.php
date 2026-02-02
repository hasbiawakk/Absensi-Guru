<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\QrController;
use App\Http\Controllers\AttendanceController;
use App\Models\QrToken;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/admin/qr', function () {
    $today = Carbon::today();
    $qr = QrToken::firstOrCreate(
        ['tanggal' => $today],
        ['token' => Str::random(40)]
    );
    return view('admin.qr', compact('qr'));
    })->name('admin.qr');

});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    });

    Route::get('/guru/absensi', [AttendanceController::class, 'index'])
        ->name('guru.absensi');

    Route::get('/guru/riwayat', [\App\Http\Controllers\AttendanceController::class, 'riwayat'])
        ->name('guru.riwayat');
});

Route::get('/absen/{token}', [AttendanceController::class, 'scan']);
Route::post('/absen', [AttendanceController::class, 'store'])
    ->middleware(['auth', 'role:guru']);

Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/absen', function () {
        if (!auth()->check()) {
            return redirect('/login');
        }
        return view('absen.form');
    })->name('absen');


    Route::post('/absen', [AttendanceController::class, 'store'])
    ->middleware(['auth', 'role:guru']);

});
