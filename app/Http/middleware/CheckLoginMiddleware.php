<?php

namespace App\Http\Middleware;


use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\Helpers;

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
        
        // if token modifyed or token null redirect to login
        if (!$token) {
            return redirect()
            ->route('login')
            ->with('error', 'Unauthorized');
        }
            
            // create Helpers class instance and then send token for verifying on VerifyCookie function
            $helperObj = new Helpers();
            $send_cookie_for_Verify = $helperObj->VerifyCookie($token);

            if(!$send_cookie_for_Verify['success']){
            return redirect()
            ->route('login')
            ->with('error', $send_cookie_for_Verify['message']);
            }
            


        return $next($request);
    }
}
