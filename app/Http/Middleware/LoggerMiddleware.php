<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * On request terminate
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     */
    public function terminate($request, $response)
    {
        $payload = json_encode($request->all());
        $content = $response->getContent();
        $options = [$request->getClientIp(), $response->getStatusCode(),  $request->getMethod(), $request->fullUrl(), $payload, $content];
        Log::info('GATEWAY-SERVICE RequestResponse', $options);
    }
}
