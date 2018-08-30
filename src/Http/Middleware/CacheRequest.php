<?php

namespace Orbitali\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CacheRequest
{
    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     */
    public function handle($request, $next)
    {
        $arrayExceptingItems = ["_previous", "PHPDEBUGBAR_STACK_DATA"];
        if (!Auth::check()) {
            $arrayExceptingItems[] = "_token";
        }
        return Cache::get(
            hash("md4", $request->fullUrl() . "#" . serialize(array_except(Session::all(), $arrayExceptingItems))),
            function () use ($next, $request) {
                return $next($request);
            }
        );
    }
}
