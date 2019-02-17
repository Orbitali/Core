<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Website;
use Illuminate\Support\Facades\Route;

class OrbitaliLoader
{
    private $languages = [];
    private $countries = [];

    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        /* if ($this->captureLocalization($request)) {
             $segment = $request->segment(1);
             $dupRequest = $request->duplicate();
             $dupRequest->server->set('REQUEST_URI', str_replace($segment, '', $request->path()));
             return $next($dupRequest);
         }*/

        $website = Website::where('domain', $request->header("host"))->first();
        if (!is_null($website)) {
            orbitali("website", $website);
            $url = $website->urls()->where('url', '/' . $request->path())->first();
            if (!is_null($url)) {
                orbitali("url", $url);
                $relation = $url->model;
                if (!is_null($relation)) {
                    orbitali('relation', $relation);
                    $parent = $url->model->parent;
                    if (!is_null($parent)) {
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

    public function captureLocalization($request)
    {
        $this->languages = require __DIR__ . '/../../Database/languages.php';
        $this->countries = require __DIR__ . '/../../Database/countries.php';
        $localeCaptureType = config("orbitali.localizationCaptureType");

        if (!is_int($localeCaptureType) && ($localeCaptureType = intval($localeCaptureType)) == 0) {
            $localeCaptureType = 1;
        }

        if ($localeCaptureType == 2 && $this->setLocale($request->getPreferredLanguage())) {
            return false;
        }

        if (in_array($localeCaptureType, [2, 1]) && $this->setLocale($request->segment(1, ""))) {
            return true;
        }

        // TODO return default site language
        $this->setLocale("tr");
        return false;
    }

    /**
     * set locale of CRM
     * @param string $locale
     * @return bool
     */
    public function setLocale(string $locale): bool
    {
        if (($locale = $this->checkLocaleExist($locale)) !== false) {
            app()->setLocale($locale);
            return true;
        }
        return false;
    }

    /**
     * Check locale existing in conf
     * @param $locale
     * @return false|string
     */
    private function checkLocaleExist($locale)
    {
        if (preg_match("/^(?<lang>[a-z|A-Z]{2})([-_](?<country>[a-z|A-Z]{2}))?$/", $locale, $matches)) {

            $language = mb_strtolower($matches["lang"]);
            if (!key_exists($language, $this->languages)) {
                return false;
            }
            $this->orbitali->language = $language;

            if (isset($matches["country"])) {
                $country = mb_strtoupper($matches["country"]);
                if (key_exists($country, $this->countries)) {
                    $this->orbitali->country = $country;
                    return $this->orbitali->language . '_' . $this->orbitali->country;
                }
            }

            return $this->orbitali->language;
        }
        return false;
    }
}
