<?php

namespace Orbitali\Http\Middleware;

use Orbitali\Foundations\Model;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Website;
use Orbitali\Http\Models\WebsiteDetail;
use Orbitali\Http\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Orbitali\Foundations\Helpers\Relation;
use Illuminate\Contracts\Cookie\QueueingFactory as CookieJar;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Orbitali\Foundations\StatusScope;

class OrbitaliLoader
{
    protected $orbitali;
    protected $request;
    protected $redirect;
    protected $etag;
    protected $cookies;

    public function __construct(
        CookieJar $cookies,
        Orbitali $orbitali,
        MetaInterface $meta
    ) {
        $this->cookies = $cookies;
        $this->orbitali = $orbitali;
        $this->orbitali->meta = $meta;
    }

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
        $this->appendTrackingKey();

        $isSuccess = $this->fillWebsite();
        $isSuccess = $isSuccess && $this->fillUrl();
        $isSuccess = $isSuccess && $this->fillRelation();
        $isSuccess = $isSuccess && $this->fillParent();
        $isSuccess = $isSuccess && $this->fillNode();

        if (!$isSuccess && isset($this->redirect)) {
            return $this->redirect;
        }

        //TODO If page has csrf token, it has to continue to middleware
        // if (!$this->checkETag($this->etag)) {
        if ($isSuccess) {
            $this->fillMeta();
        }
        $response = $next($request);
        // } else {
        //     $response = response("", 304);
        // }

        $this->postHandler($response);

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
        if (!is_null($this->orbitali->website->redirect_id)) {
            $this->orbitali->website = $this->orbitali->website->redirect;
        }
        return true;
    }

    private function fillUrl()
    {
        $path = Str::of("/" . $this->request->path())
            ->rtrim("/")
            ->__toString();
        if (empty($path)) {
            $path = "/";
        }

        $this->orbitali->url = $this->orbitali->website
            ->urls()
            ->where("url", $path)
            ->first();
        if (is_null($this->orbitali->url)) {
            return false;
        }

        if ($this->orbitali->url->type == "redirect") {
            if(is_null($this->orbitali->url->deleted_at)){
                $this->redirect = redirect($this->orbitali->url->model->url);
            }
            return false;
        }

        //$this->orbitali->url->setRelation("website", $this->orbitali->website);

        $this->etag = md5(
            $this->orbitali->url->url . "#" . $this->orbitali->url->updated_at
        );
        return true;
    }

    private function fillRelation()
    {
        $this->orbitali->relation = $this->orbitali->url->model;
        if (is_null($this->orbitali->relation)) {
            return false;
        }
        //$this->orbitali->relation->setRelation("url", $this->orbitali->url);
        $this->orbitali->language = $this->orbitali->relation->language;
        $this->orbitali->country = $this->orbitali->relation->country;
        app()->setLocale($this->orbitali->language);
        return $this->orbitali->website->languages->contains(
            $this->orbitali->language
        );
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
            $this->orbitali->parent->status != StatusScope::ACTIVE
        ) {
            return false;
        }

        //$this->orbitali->parent->setRelation("detail",$this->orbitali->relation);
        return true;
    }

    private function fillNode()
    {
        if (is_a($this->orbitali->parent, Node::class)) {
            $className = $this->orbitali->parent->type;
            $this->orbitali->node = $this->orbitali->parent;
            //$this->orbitali->node->setRelation("website",$this->orbitali->website);
        } elseif (is_a($this->orbitali->parent, Website::class)) {
            $className = "Website";
        } elseif (is_a($this->orbitali->parent, User::class)) {
            $className = "User";
        } else {
            $className = $this->orbitali->parent->node->type;
            $this->orbitali->node = $this->orbitali->parent->node;
            //$this->orbitali->node->setRelation("website",$this->orbitali->website);
        }

        $this->fillRoute($className);
        return true;
    }

    private function fillRoute($className)
    {
        $class =
            "\App\Http\Controllers\\" .
            Str::studly(Str::snake($className)) .
            "Controller";
        if (!class_exists($class) && app()->isLocal()) {
            $this->orbitali->class = $class;
            $class = "\Orbitali\Http\Controllers\DefaultController";
        }
        $class .= "@";
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

    private function checkETag($etag)
    {
        $requestEtag = str_replace("W/", "", $this->request->getETags());
        $requestEtag = str_replace('"', "", $requestEtag);
        return in_array($etag, $requestEtag) || in_array("*", $requestEtag);
    }

    private function appendTrackingKey()
    {
        $currentID = $this->request->cookie("opanel-track", uniqid("", true));
        $this->request->headers->set("opanel-track", $currentID);
        $this->cookies->queue(
            $this->cookies->forever("opanel-track", $currentID)
        );
    }

    private function postHandler(&$response)
    {
        if (isset($this->etag)) {
            $response->setEtag($this->etag, true);
            $response->setLastModified($this->orbitali->url->updated_at);
            $response->setPublic();
        } else {
            $newEtag = md5(
                json_encode($response->headers->get("origin")) .
                    $response->getContent()
            );
            $response->setEtag($newEtag, true);
            $response->isNotModified($this->request);
        }

        foreach ($this->cookies->getQueuedCookies() as $cookie) {
            $response->headers->setCookie($cookie);
        }
    }

    private function fillMeta()
    {
        $orb = &$this->orbitali;
        $meta = &$orb->meta;
        if ($orb->website == null) {
            return;
        }
        if (app()->isLocal()) {
            $meta->setRobots("nofollow,noindex");
        }

        $og = new OpenGraphPackage("OrbitaliOpenGraph");
        $websiteName =
            $orb->website->detail->name ??
            $orb->website->details->first()->name;
        $meta->setTitle($websiteName);
        $og->setSiteName($websiteName);

        if ($orb->relation == null) {
            return;
        }

        if (!is_a($orb->parent, Website::class)) {
            $meta->prependTitle($orb->relation->name);
            $og->setTitle($orb->relation->name);
        }

        //$meta->setDescription("Awesome page");
        //$og->setDescription("View the album on Flickr.");

        //$meta->setKeywords(["Awesome keyword", "keyword2"]);

        $og->setLocale($orb->relation->language);

        $orb->parent->loadMissing("details.url");
        foreach ($orb->parent->details as $detail) {
            if ($detail->url == null) {
                continue;
            }
            $meta->setHrefLang($detail->language, url($detail->url));
            $og->addAlternateLocale($detail->language);
        }

        $og->setType("website");
        $meta->registerPackage($og);
    }
}
