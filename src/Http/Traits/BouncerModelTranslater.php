<?php

namespace Orbitali\Http\Traits;

trait BouncerModelTranslater
{
    public $type = "";

    public function getTitleAttribute()
    {
        return trans(["native.$this->type.$this->name", $this->name]);
    }

    public function setTitleAttribute($default)
    {
        $locale = app()->getLocale();
        $line = LanguagePart::firstOrNew(
            [
                "group" => "native",
                "key" => "$this->type.$this->name",
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
