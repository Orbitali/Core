<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Foundations\Model;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Website;
use Orbitali\Http\Models\WebsiteDetail;
use Orbitali\Http\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Relation;

class OrbitaliLoader
{
    protected $orbitali;
    protected $request;
    protected $redirect;
    protected $etag;
    /**
     * Handle the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, $next)
    {
        $this->request = $request;
        $this->orbitali = orbitali();

        $isSuccess =
            $this->fillWebsite() &&
            $this->fillUrl() &&
            $this->fillRelation() &&
            $this->fillParent() &&
            $this->fillNode();

        if (!$isSuccess && isset($this->redirect)) {
            return $this->redirect;
        }

        $response = $next($request);

        if (isset($this->etag)) {
            $response->setCache([
                "etag" => $this->etag,
                "last_modified" => $this->orbitali->url->updated_at,
                "public" => true,
            ]);
        } else {
            $etag = md5(
                json_encode($response->headers->get("origin")) .
                    $response->getContent()
            );
            if ($this->checkETag($etag)) {
                $response->setNotModified();
            }
            $response->setEtag($etag);
        }
        return $response;
    }

    private function fillWebsite()
    {
        $this->orbitali->website = Website::status()
            ->where("domain", $this->request->getHost())
            ->first();
        if (is_null($this->orbitali->website)) {
            return false;
        }
        app("config")["cache.prefix"] =
            $this->orbitali->website->domain . "_cache";
        return true;
    }

    private function fillUrl()
    {
        $this->orbitali->url = $this->orbitali->website
            ->urls()
            ->where("url", "/" . $this->request->path())
            ->first();
        if (is_null($this->orbitali->url)) {
            return false;
        }
        if ($this->controlETag()) {
            return false;
        }
        if ($this->orbitali->url->type == "redirect") {
            $this->redirect = redirect($this->orbitali->url->model->url);
        }
        $this->orbitali->url->setRelation("website", $this->orbitali->website);
        return true;
    }

    private function fillRelation()
    {
        $this->orbitali->relation = $this->orbitali->url->model;
        if (is_null($this->orbitali->relation)) {
            return false;
        }
        $this->orbitali->relation->setRelation("url", $this->orbitali->url);
        $this->orbitali->language = $this->orbitali->relation->language;
        $this->orbitali->country = $this->orbitali->relation->country;
        app()->setLocale($this->orbitali->language);
        return true;
    }

    private function fillParent()
    {
        if (
            $this->orbitali->url->model_type ==
            Relation::relationFinder(WebsiteDetail::class)
        ) {
            $this->orbitali->parent = $this->orbitali->website;
        } else {
            $this->orbitali->parent = $this->orbitali->relation->parent;
        }

        if (
            is_null($this->orbitali->parent) ||
            $this->orbitali->parent->status != Model::ACTIVE
        ) {
            return false;
        }

        $this->orbitali->parent->setRelation(
            "detail",
            $this->orbitali->relation
        );
        return true;
    }

    private function fillNode()
    {
        if (is_a($this->orbitali->parent, Node::class)) {
            $className = $this->orbitali->parent->type;
            $this->orbitali->node = $this->orbitali->parent;
        } elseif (is_a($this->orbitali->parent, Website::class)) {
            $className = "Website";
        } elseif (is_a($this->orbitali->parent, User::class)) {
            $className = "User";
        } else {
            $className = $this->orbitali->parent->node->type;
            $this->orbitali->node = $this->orbitali->parent->node;
        }
        $this->orbitali->parent->node->setRelation(
            "website",
            $this->orbitali->website
        );
        $this->fillRoute($className);
        return true;
    }

    private function fillRoute($className)
    {
        $class =
            "\App\Http\Controllers\\" .
            Str::studly(Str::snake($className)) .
            "Controller@";

        if (
            $this->request->isMethod("POST") &&
            $this->request->get("form_key", false)
        ) {
            $class .= "formSubmission";
        } else {
            $class .= Str::camel($this->orbitali->url->model_type);
        }
        Route::middleware("web")->any($this->orbitali->url->url, $class);
        return true;
    }

    private function controlETag()
    {
        $this->etag = md5(
            $this->orbitali->url->url . "#" . $this->orbitali->url->updated_at
        );
        if ($this->checkETag($this->etag)) {
            $this->redirect = response()
                ->noContent()
                ->setNotModified()
                ->setCache([
                    "etag" => $this->etag,
                    "last_modified" => $this->orbitali->url->updated_at,
                ]);
            return true;
        }
        return false;
    }

    private function checkETag($etag)
    {
        $browserEtag = str_replace(
            "W/",
            "",
            str_replace('"', "", $this->request->getETags())
        );
        return $browserEtag && $browserEtag[0] == $etag;
    }
}
