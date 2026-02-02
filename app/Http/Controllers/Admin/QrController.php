<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\QrCode;

class QrController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $qr = QrCode::firstOrCreate(
            ['tanggal' => $today],
            ['token' => Str::random(40)]
        );

        return view('admin.qr', compact('qr'));
    }
}
