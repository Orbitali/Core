<?php

namespace Orbitali\Http\Models;

use Silber\Bouncer\Database\Role as BRole;

class Role extends BRole
{
    public function getTitleAttribute()
    {
        return trans(["native.role.$this->name", $this->name]);
    }

    public function setTitleAttribute($default)
    {
        $locale = app()->getLocale();
        $line = LanguagePart::firstOrNew(
            [
                'group' => 'native',
                'key' => "role.$this->name"
            ],
            [
                'text' => [$locale => $default]
            ]
        );

        if ($line->exists && !$line->hasLocale($locale)) {
            $line->setTranslation($locale, $default)->save();
        } else if (!$line->exists) {
            $line->save();
        }

        unset($this->attributes["title"]);
    }
}
