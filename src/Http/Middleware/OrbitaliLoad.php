<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Facades\Orbitali;

class OrbitaliLoad
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
        Orbitali::getFacadeRoot();
        return $next($request);
    }
}
