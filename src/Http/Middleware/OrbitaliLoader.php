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
            app('config')['cache.prefix'] = $website->domain . "_cache";
            $url = $website->urls()->where('url', '/' . $request->path())->first();
            if (!is_null($url)) {
                if ($url->type == "redirect") {
                    //TODO:Check logic and write UrlEngine
                    return redirect($url->model->url);
                }

                //Check ETag
                $requestEtag = $request->getETags();
                $etag = md5("$url->url#$url->updated_at");
                if ($requestEtag && $requestEtag[0] == $etag) {
                    return response()->setNotModified()->setCache(["etag" => $etag, "last_modified" => $url->updated_at]);
                }

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
                        $class = '\App\Http\Controllers\\' . studly_case(snake_case($node->type)) . "Controller@";
                        if ($request->isMethod("POST") && $request->get('form_key', false)) {
                            $class .= "formSubmission";
                        } else {
                            $class .= camel_case($url->model_type);
                        }
                        Route::any($url->url, $class);
                    }
                }
            }
        }

        $response = $next($request);
        if (isset($etag)) {$response->setCache(["etag" => $etag, "last_modified" => $url->updated_at, "public" => true]);}
        else {
            $etag = md5(json_encode($response->headers->get('origin')).$response->getContent());
            $requestEtag = str_replace('"', '', $request->getETags());
            if ($requestEtag && $requestEtag[0] == $etag) {
                $response->setNotModified();
            }
            $response->setEtag($etag);
        }
        return $response;
    }
}
