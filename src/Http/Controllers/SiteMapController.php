<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Website;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    private $urlQuery;
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Orbitali $orbitali, Request $request)
    {
        $request->merge(["page" => app("router")->input("page", 1)]);
        $this->urlQuery = $orbitali->website
            ->urls()
            ->where("type", "original")
            ->whereHas("model", function ($detail) {
                return $detail->whereHas("parent");
            })
            ->with("model.parent")
            ->paginate(10000);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function sitemapIndex(Orbitali $orbitali)
    {
        $urls = collect()
            ->range(1, $this->urlQuery->lastPage())
            ->map(function ($page) {
                return [
                    "loc" => route("website.sitemap", $page),
                ];
            });

        return response()
            ->view("Orbitali::website.sitemap.list", compact("urls"))
            ->header("Content-Type", "text/xml");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function urlSet()
    {
        $urls = $this->urlQuery->map(function ($url) {
            return [
                "loc" => url($url->url),
                "lastmod" => $url->model->parent->updated_at
                    ->tz("UTC")
                    ->toAtomString(),
                "changefreq" => $this->getChangefreq($url),
                "priority" => $this->getPriortiy($url),
            ];
        });

        return response()
            ->view("Orbitali::website.sitemap.index", compact("urls"))
            ->header("Content-Type", "text/xml");
    }

    private function getPriortiy($url)
    {
        switch (get_class($url->model)) {
            case \Orbitali\Http\Models\WebsiteDetail::class:
                $priortiy = 1;
                break;
            case \Orbitali\Http\Models\NodeDetail::class:
                $priortiy = 0.75;
                break;
            case \Orbitali\Http\Models\PageDetail::class:
                $priortiy = 0.5;
                break;
            case \Orbitali\Http\Models\CategoryDetail::class:
                $priortiy = 0.5;
                break;
            default:
                $priortiy = 0.4;
                break;
        }
        return $priortiy;
    }

    private function getChangefreq($url)
    {
        $diff = now()->diff($url->model->parent->created_at);
        $freq = "always";
        if ($diff->y > 0) {
            $freq = "yearly";
        } elseif ($diff->m > 0) {
            $freq = "monthly";
        } elseif ($diff->d > 6) {
            $freq = "weekly";
        } elseif ($diff->d > 0 && $diff->d < 7) {
            $freq = "daily";
        } elseif ($diff->h > 0) {
            $freq = "hourly";
        }
        return $freq;
    }
}
