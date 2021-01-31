<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Foundations\Cache\ResponseSerializer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CacheRequest
{
    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws
     */
    public function handle($request, $next)
    {
        if ($this->shouldCacheRequest($request)) {
            $key = $this->getCacheKey($request);

            if (Cache::has($key)) {
                $response = Cache::get($key);
                return (new ResponseSerializer())->unSerialize($response);
            }

            $response = $next($request);
            if ($this->shouldCacheResponse($response)) {
                Cache::forever(
                    $key,
                    (new ResponseSerializer())->serialize($response)
                );
            }
            return $response;
        }
        return $next($request);
    }

    private function shouldCacheRequest($request): bool
    {
        return !Str::startsWith($request->route()->getName(), "panel.") &&
            !$request->ajax() &&
            $request->isMethod("get");
    }

    private function getCacheKey($request)
    {
        $arrayExceptingItems = ["_previous", "_flash"];
        if (Auth::guest()) {
            $arrayExceptingItems[] = "_token";
        }
        $sessionData = Session::all();
        $orbitaliUrl = orbitali("url");
        if (isset($orbitaliUrl)) {
            $sessionData["updated_at"] = $orbitaliUrl->updated_at->__toString();
        }
        return "orbitali.cache.middleware." .
            mb_strtolower($request->getMethod()) .
            "." .
            hash(
                "md4",
                $request->fullUrl() .
                    "#" .
                    app()->getLocale() .
                    serialize(Arr::except($sessionData, $arrayExceptingItems))
            );
    }

    private function shouldCacheResponse($response): bool
    {
        return $response->isSuccessful() || $response->isRedirection();
    }
}
