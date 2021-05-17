<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Foundations\Cache\ResponseSerializer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CacheRequest
{
    private static $arrayExceptingItems = ["_previous", "_flash", "_token"];
    private static $prependCacheKey = "orbitali.cache.middleware.";
    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws
     */
    public function handle(Request $request, $next)
    {
        if ($this->shouldCacheRequest($request)) {
            $key = $this->getCacheKey($request);
            $serializer = new ResponseSerializer();
            $cachedResponse = Cache::get($key);
            if ($cachedResponse != null) {
                $response = $serializer->unSerialize($cachedResponse);
                return $response;
            }

            $response = $next($request);

            if ($this->shouldCacheResponse($response)) {
                Cache::forever($key, $serializer->serialize($response));
            }
            return $response;
        }

        return $next($request);
    }

    private function getCacheKey(Request $request)
    {
        $session = $request->getSession();
        $sessionData = $session->all();
        $sessionData["url"] = $request->fullUrl();
        $orbitaliUrl = orbitali("url");
        if (isset($orbitaliUrl)) {
            $sessionData["updated_at"] = $orbitaliUrl->updated_at->__toString();
        }
        Arr::forget($sessionData, self::$arrayExceptingItems);
        return self::$prependCacheKey . hash("md4", json_encode($sessionData));
    }

    private function shouldCacheRequest(Request $request): bool
    {
        return !Str::startsWith($request->route()->getName(), "panel.") &&
            $request->isMethodCacheable();
    }

    private function shouldCacheResponse($response): bool
    {
        return $response->isSuccessful();
    }
}
