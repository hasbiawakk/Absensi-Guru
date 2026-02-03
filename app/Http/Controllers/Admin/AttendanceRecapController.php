<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceRecapController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? now()->format('Y-m-d');

        $attendances = Attendance::with('user')
            ->whereDate('tanggal', $tanggal)
            ->orderBy('jam_absen', 'asc')
            ->get();

        return view('admin.rekap', compact('attendances', 'tanggal'));
    }
}
