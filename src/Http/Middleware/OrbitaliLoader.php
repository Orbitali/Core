<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Foundations\Model;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Website;
use Illuminate\Support\Facades\Route;

class OrbitaliLoader
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
        $website = Website::status()->where('domain', $request->header("host"))->first();
        if (!is_null($website)) {
            orbitali("website", $website);
            $url = $website->urls()->where('url', '/' . $request->path())->first();
            if (!is_null($url)) {
                orbitali("url", $url);
                $relation = $url->model;
                if (!is_null($relation)) {
                    orbitali('relation', $relation);
                    orbitali('language', $relation->language);
                    app()->setLocale($relation->language);
                    orbitali('country', $relation->country);
                    $parent = $url->model->parent;
                    if (!is_null($parent) && $parent->status == Model::ACTIVE) {
                        orbitali('parent', $parent);
                        $node = is_a($parent, Node::class) ? $parent : $parent->node;
                        orbitali('node', $node);
                        $class = '\App\Http\Controllers\\' . studly_case(snake_case($node->type)) . "Controller@" . camel_case($url->model_type);
                        Route::any($url->url, $class);
                    }
                }
            }
        }

        return $next($request);
    }
}
