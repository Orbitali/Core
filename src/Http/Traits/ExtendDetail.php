<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\Model;
use Illuminate\Support\Str;

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
        $url->save();
    }

    public function getSlugAttribute()
    {
        return $this->url;
    }

    public static function isIgnoringTouch($class = null)
    {
        return true;
    }
}
