<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Foundations\ResponseSerializer;
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
        if ($this->shouldCacheRequest($request)) {
            $key = $this->getCacheKey($request);

            if (Cache::has($key)) {
                $response = Cache::get($key);
                return (new ResponseSerializer())->unserialize($response);
            }

            $response = $next($request);
            if ($this->shouldCacheResponse($response)) {
                Cache::put($key, (new ResponseSerializer())->serialize($response), 60);
            }
            return $response;

        } else {
            return $next($request);
        }
    }

    private function getCacheKey($request)
    {
        $arrayExceptingItems = ["_previous", '_flash'];
        if (!Auth::check()) {
            $arrayExceptingItems[] = "_token";
        }
        return "orbitali.cache.middleware." . mb_strtolower($request->getMethod()) . "." . hash("md4", $request->fullUrl() . "#" . serialize(array_except(Session::all(), $arrayExceptingItems)));
    }

    private function shouldCacheRequest($request): bool
    {
        return !$request->ajax() && $request->isMethod('get');
    }

    private function shouldCacheResponse($response): bool
    {
        return $response->isSuccessful() || $response->isRedirection();
    }
}
