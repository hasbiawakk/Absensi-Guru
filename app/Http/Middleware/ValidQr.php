<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\QrToken;

class ValidQr
{
    public function handle(Request $request, Closure $next)
    {
        $qrToken = $request->query('qr');

        // QR token wajib ada
        if (!$qrToken) {
            return response()->view('guru.qr-invalid', [], 403);
        }

        // Cek QR di database
        $qr = QrToken::where('token', $qrToken)
            ->whereDate('tanggal', now())
            ->first();

        if (!$qr) {
            return response()->view('guru.qr-expired', [], 403);
        }

        // Simpan data QR ke request (biar bisa dipakai controller)
        $request->merge([
            'qr_data' => $qr
        ]);

        return $next($request);
    }
}
