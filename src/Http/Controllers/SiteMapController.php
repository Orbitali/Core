<?php

namespace Orbitali\Http\Controllers;

use App\Http\Controllers\Controller;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Models\Website;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    private $urls;
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct(Orbitali $orbitali, Request $request)
    {
        $request->merge(["page" => app("router")->input("page", 1)]);
        $this->urls = orbitali()
            ->website->urls()
            ->where("type", "original")
            ->whereHas("model", function ($detail) {
                return $detail->whereHas("parent", function ($parent) {
                    return $parent->status();
                });
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
            ->range(1, $this->urls->lastPage())
            ->map(function ($page) {
                return (object) [
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
    public function urlSet(Orbitali $orbitali)
    {
        $urls = $this->urls->map(function ($url) {
            return (object) [
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
                return 1;
            case \Orbitali\Http\Models\NodeDetail::class:
                return 0.75;
            case \Orbitali\Http\Models\PageDetail::class:
                return 0.5;
            case \Orbitali\Http\Models\CategoryDetail::class:
                return 0.5;
            default:
                return 0.4;
        }
    }

    private function getChangefreq($url)
    {
        $diff = now()->diff($url->model->parent->created_at);
        if ($diff->y > 0) {
            return "yearly";
        } elseif ($diff->m > 0) {
            return "monthly";
        } elseif ($diff->d > 6) {
            return "weekly";
        } elseif ($diff->d > 0 && $diff->d < 7) {
            return "daily";
        } elseif ($diff->h > 0) {
            return "hourly";
        } else {
            return "always";
        }
    }
}
