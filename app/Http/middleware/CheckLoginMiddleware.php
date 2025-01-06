<?php

namespace App\Http\Middleware;


use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoginMiddleware
{

    /**
     * Handle an incoming request.
     *
     *  @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * 
     * 
     */

    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('user');

        if (!$token) {
            return redirect()
            ->route('login')
            ->with('error', 'Unauthorized');
        }

        try {
            $decodedCookie = decrypt($token);
            $actualCookie = env('AUTH_COOKIE');

            if ($decodedCookie !== $actualCookie) {
                return redirect()
                    ->route('login')
                    ->with('error', 'Session expire');
            }
        } catch (Exception $e) {
            return redirect()
                ->route('login')
                ->with('error', "Invalid Cookie Format");
        }

        return $next($request);
    }
}
