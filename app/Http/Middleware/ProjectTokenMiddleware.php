<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = 'Bearer NGZlI5RQebdYHOTu1669qAnHsmwSZZgAGivVEzLM9kcEsOvfpb';
        if ($request->headers->get('Authorization') === $token) {
            return $next($request);
        }

        return response()->json('Forbidden!', 403);
    }
}
