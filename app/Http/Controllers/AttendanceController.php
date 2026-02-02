<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;  
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();

        // CEK: sudah absen hari ini?
        $already = Attendance::where('user_id', $user->id)
            ->whereDate('tanggal', $today)
            ->exists();

        if ($already) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini.');
        }

        // VALIDASI FORM
        $request->validate([
            'status' => 'required|in:hadir,izin,sakit',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $buktiPath = null;

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('bukti-absensi', 'public');
        }

        Attendance::create([
            'user_id'   => $user->id,
            'tanggal'   => $today,
            'jam_absen' => Carbon::now()->format('H:i:s'),
            'status'    => $request->status,
            'bukti'     => $buktiPath,
        ]);

        return redirect('/guru/dashboard')->with('success', 'Absensi berhasil disimpan.');
    }

    public function index()
    {
        $absensi = Attendance::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_absen', 'desc')
            ->get();

        return view('guru.absensi', compact('absensi'));
    }

    public function riwayat()
    {
        $user = Auth::user();

        $riwayat = Attendance::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('guru.riwayat', compact('riwayat'));
    }  
}
