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
     * @return mixed
     */
    public function handle($request, $next)
    {
        if (Cache::getStore() instanceof \Illuminate\Cache\TaggableStore) {
            Cache::tags('views')->flush();
        } else {
            Cache::flush();
        }
        return $next($request);
    }
}
