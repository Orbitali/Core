<?php

namespace Orbitali\Http\Traits;

use Orbitali\Http\Models\LanguagePart;

trait BouncerModelTranslater
{
    public function getTitleAttribute()
    {
        return trans(["native.$this->table.$this->name", $this->name]);
    }

    public function setTitleAttribute($default)
    {
        $locale = app()->getLocale();
        $line = LanguagePart::firstOrNew(
            [
                "group" => "native",
                "key" => "$this->table.$this->name",
            ],
            [
                "text" => [$locale => $default],
            ]
        );

        if ($line->exists && !$line->hasLocale($locale)) {
            $line->setTranslation($locale, $default)->save();
        } elseif (!$line->exists) {
            $line->save();
        }

        unset($this->attributes["title"]);
    }
}
