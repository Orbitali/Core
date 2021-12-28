<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

trait ExtendDetail
{
    public function setSlugAttribute($value)
    {
        $this->url->url = Str::of($value)->rtrim("/");
        if ($this->url->url->isEmpty()) {
            $this->url->url = "/";
        }

        if ($this->url->exists && $this->url->isDirty("url")) {
            $this->url->redirects()->updateOrCreate([
                "website_id" => $this->url->getOriginal("website_id"),
                "type" => "redirect",
                "url" => $this->url->getOriginal("url"),
            ]);
        }
        return $this;
    }

    public function getSlugAttribute()
    {
        return $this->url;
    }

    public static function isIgnoringTouch($class = null)
    {
        return true;
    }

    public function newCollection(array $models = [])
    {
        $collection = new Collection($models);
        return $collection;
        return $collection
            ->keyBy([self::class, "getDetailKeyAttribute"])
            ->concat($collection->keyBy("id"));
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
}
