<?php

namespace Orbitali\Http\Middleware;

class FlushViews
{
    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, $next)
    {
        $cache = cache();
        if ($cache->getStore() instanceof \Illuminate\Cache\TaggableStore) {
            $cache->tags("views")->flush();
        }
        $cache->flush();

        return $next($request);
    }
}
