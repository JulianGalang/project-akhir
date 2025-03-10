<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdminVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->status === 'owner' || Auth::user()->status === 'admin') {
            if(Auth::user()->email_verified_at !== null) {
                return $next($request);
            }else{
                $request->user()->sendEmailVerificationNotification();
                $request->session()->put('verification-link-sent',true);
                return redirect()->route('verification.notice');            }
        }
        abort(403, 'Anda tidak memiliki akses ke halaman ini!');
    }
}
