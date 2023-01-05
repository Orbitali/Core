<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

trait ExtendDetail
{
    use DetailModel;

    public function setSlugAttribute($value)
    {
        $newUrl = Str::of($value)->rtrim("/")->__toString();
        $this->url->url = $newUrl;

        if (Str::of($this->url->url)->isEmpty()) {
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
}
