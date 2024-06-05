<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Request Logged:', ['url' => $request->url(), 'method' => $request->method(), 'data' => $request->all()]);

        return $next($request);
    }
}
