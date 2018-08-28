<?php

namespace Orbitali\Http\Middleware;

use Cache;

class FlushViews
{
    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     */
    public function handle($request, $next): \Closure
    {
        Cache::tags('views')->flush();
        return $next($request);
    }
}
