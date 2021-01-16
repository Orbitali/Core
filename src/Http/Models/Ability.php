<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\Ability as BAbility;

class Ability extends BAbility
{
    public function getTitleAttribute()
    {
        return trans(["native.ability.$this->name", $this->name]);
    }

    public function setTitleAttribute($default)
    {
        $locale = app()->getLocale();
        $line = LanguagePart::firstOrNew(
            [
                "group" => "native",
                "key" => "ability.$this->name",
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
