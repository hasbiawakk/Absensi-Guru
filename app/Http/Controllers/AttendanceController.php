<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrToken;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * =========================
     * SCAN QR
     * =========================
     */
    public function scan($token, Request $request)
    {
        $qr = QrToken::where('token', $token)
            ->whereDate('tanggal', Carbon::today())
            ->first();

        if (!$qr) {
            abort(403, 'QR tidak valid atau sudah kadaluarsa');
        }

        // jika belum login → login dulu
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('info', 'Silakan login untuk melanjutkan absensi');
        }

        session(['qr_token' => $token]);

        dd('SCAN TERPANGGIL', $token);

        return redirect()->route('guru.absensi');
    }

    /**
     * =========================
     * FORM ABSENSI
     * =========================
     */
    public function index()
    {
        if (!session()->has('qr_token')) {
            dd('SESSION HILANG', session()->all());
        }

        return view('absen.form');
    }



    /**
     * =========================
     * SIMPAN ABSENSI
     * (MASUK / PULANG)
     * =========================
     */
    public function store(Request $request)
    {
        $token = session('qr_token');
        
        if (!$token) {
            return redirect()->route('guru.dashboard')
                ->with('error', 'Session QR tidak ditemukan');
        }

        // validasi token QR
        $qr = QrToken::where('token', $token)
            ->whereDate('tanggal', Carbon::today())
            ->first();

        if (!$qr) {
            return redirect('/')
                ->with('error', 'Token QR tidak valid atau kadaluarsa');
        }

        $user = Auth::user();
        $today = Carbon::today();

        // ambil absensi hari ini
        $attendance = Attendance::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        /**
         * =========================
         * SCAN PERTAMA → MASUK
         * =========================
         */
        if (!$attendance) {

            Attendance::create([
                'user_id'    => $user->id,
                'tanggal'    => $today,
                'status'     => 'hadir',
                'jam_masuk'  => now()->format('H:i:s'),
            ]);

            session()->forget('qr_token');

            return redirect()->route('guru.dashboard')
                ->with('success', 'Absensi berhasil');  
        }

        /**
         * =========================
         * SCAN KEDUA → PULANG
         * =========================
         */
        if ($attendance->jam_masuk && !$attendance->jam_pulang) {

            $attendance->update([
                'jam_pulang' => now()->format('H:i:s')
            ]);

            session()->forget('qr_token');

            return redirect('/guru/dashboard')
                ->with('success', '✅ Absen PULANG berhasil');
        }

        /**
         * =========================
         * SUDAH MASUK & PULANG
         * =========================
         */
        return redirect('/guru/dashboard')
            ->with('info', 'ℹ️ Anda sudah absen masuk dan pulang hari ini');
    }

    /**
     * =========================
     * RIWAYAT ABSENSI GURU
     * =========================
     */
    public function riwayat()
    {
        $data = Attendance::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.riwayat', compact('data'));
    }

    /**
     * =========================
     * DASHBOARD
     * =========================
     */

    public function dashboard()
    {
        $userId = auth()->id();
        $now = Carbon::now();

        // Absensi hari ini
        $attendanceToday = Attendance::where('user_id', $userId)
            ->whereDate('tanggal', $now->toDateString())
            ->first();

        // Hadir bulan ini
        $hadirBulanIni = Attendance::where('user_id', $userId)
            ->whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $now->year)
            ->where('status', 'hadir')
            ->count();

        // Izin + Sakit bulan ini
        $izinSakit = Attendance::where('user_id', $userId)
            ->whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $now->year)
            ->whereIn('status', ['izin', 'sakit'])
            ->count();

        // ❗ ALPHA bulan ini (INI YANG KURANG)
        $alpha = Attendance::where('user_id', $userId)
            ->whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $now->year)
            ->where('status', 'alpha')
            ->count();

        return view('guru.dashboard', compact(
            'attendanceToday',
            'hadirBulanIni',
            'izinSakit',
            'alpha'
        ));
    }


}
