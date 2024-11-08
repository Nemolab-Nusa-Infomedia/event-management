<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerificationEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->email_verified_at == null) {
            if (Auth::check() && Auth::user()->email_verification_expired_at < now()) {
                User::whereNull('email_verified_at')->where('email_verification_expired_at', '<', now())->delete();
                return redirect('/register')->with('message', 'Akun Anda telah dihapus karena tidak memverifikasi email dalam waktu yang ditentukan.');
            }
            return redirect()->route('verification.notice')->with('message', 'Harap verifikasi terlebih dahulu');
        }

        return $next($request);
    }
}
