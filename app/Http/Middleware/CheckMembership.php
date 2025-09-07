<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request -> Membership == true) {
            return redirect('/pricing');
        }

        Log::info('before request passed middleware', [
            'url' => $request->Url(),
            'params' => $request->all(),
        ]);


       $response = $next($request);

        sleep(2); // Simulate some processing delay

       Log::info('after request passed middleware', [
            'status' => $response->getStatusCode(),
            'response' => $response-> getContent(),
       ]);

       return $response;
    }
}
