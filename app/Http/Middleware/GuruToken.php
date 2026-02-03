<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Guru;

class GuruToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = Cookie::get('guru_token');

        // Belum pernah login di device ini
        if (!$token) {
            return redirect()->route('guru.login', [
                'qr' => $request->query('qr')
            ]);
        }

        $guru = Guru::where('token', $token)->first();

        // Token tidak valid (hapus cookie)
        if (!$guru) {
            Cookie::queue(Cookie::forget('guru_token'));

            return redirect()->route('guru.login', [
                'qr' => $request->query('qr')
            ]);
        }

        // Inject guru ke request
        $request->merge([
            'guru_auth' => $guru
        ]);

        return $next($request);
    }
}
