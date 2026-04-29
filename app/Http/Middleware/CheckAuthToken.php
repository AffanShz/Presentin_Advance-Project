<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     *  
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('refreshToken')) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        
        $token = Session::get('refreshToken');
        $tokenParts = explode('.', $token);
        if (count($tokenParts) === 3) {
            $payload = json_decode(base64_decode($tokenParts[1]), true);
            if (isset($payload['exp']) && $payload['exp'] < time()) {
                Session::flush();
                return redirect('/login')->with('error', 'Token telah kedaluwarsa. Silakan login kembali.');
            }
        }
        return $next($request);
    }
}
