<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            // !auth()->check() ==> kalau user belum login
            // !auth()->user()->is_admin ==> kalau user sudah login tapi BUKAN admin
            // pengecekan admin di sini dilakukan dengan memberi tanda NOT (!) ke nilai dari is_admin
            // is_admin adalah field / kolom dari tabel user yang nilainya 1 (TRUE) dan 0 (FALSE)
            abort(403);
        }
        return $next($request);
    }
}
