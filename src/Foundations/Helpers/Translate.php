<?php

namespace Orbitali\Foundations\Helpers;

class Translate
{
    public static function key_split_and_save_for_trans(&$key, $locale)
    {
        if (is_array($key)) {
            $default = $key[1];
            $key = $key[0];

            [$namespace, $group, $item] = app('translator')->parseKey($key);

            if ($locale === null) {
                $locale = app()->getLocale();
            }

            if ($item != "" && !app("translator")->hasForLocale($key, $locale)) {
                $line = \Orbitali\Http\Models\LanguagePart::firstOrNew(
                    [
                        'group' => $group,
                        'key' => $item
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
            }
        }
    }

}
