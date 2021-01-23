<?php

namespace Orbitali\Http\Middleware;

class Localization
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
        app()->setLocale(orbitali()->language);
        return $next($request);
    }
}
