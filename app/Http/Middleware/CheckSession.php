<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Jika user tidak terautentikasi, anggap session telah berakhir
            $user = Auth::user();
            //$user = User::where(Auth::id());
            if ($user) {
                $user->active_status = 0;
                $user->save();
            }
        }

        return $next($request);
    }
}
