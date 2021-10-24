<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

trait ExtendDetail
{
    public function setSlugAttribute($value)
    {
        /** @var Model $url */
        $url = $this->url()->firstOrNew([
            "website_id" => orbitali("website")->id,
            "type" => "original",
        ]);

        $url->url = Str::of($value)
            ->rtrim("/")
            ->__toString();
        if (empty($url->url)) {
            $url->url = "/";
        }
        if ($url->isDirty("url") && $url->exists) {
            $url->redirects()->updateOrCreate([
                "website_id" => $url->getOriginal("website_id"),
                "type" => "redirect",
                "url" => $url->getOriginal("url"),
            ]);
        }
    }

    public function getSlugAttribute()
    {
        return $this->url;
    }

    public static function isIgnoringTouch($class = null)
    {
        return true;
    }

    public static function getDetailKeyAttribute($item)
    {
        if (is_null($item->getAttribute("country"))) {
            return $item->getAttribute("language");
        }
        return $item->getAttribute("language") .
            "|" .
            $item->getAttribute("country");
    }

    public function newCollection(array $models = [])
    {
        $collection = new Collection($models);
        return $collection;
        return $collection
            ->keyBy([self::class, "getDetailKeyAttribute"])
            ->concat($collection->keyBy("id"));
    }
}
