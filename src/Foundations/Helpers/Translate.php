<?php

namespace Orbitali\Foundations\Helpers;
use Orbitali\Http\Models\LanguagePart;

class Translate
{
    public static function key_split_and_save_for_trans(&$key, $locale)
    {
        if (is_array($key)) {
            $default = $key[1];
            $key = $key[0];

            $translator = app("translator");
            [$namespace, $group, $item] = $translator->parseKey($key);

            if (is_null($locale)) {
                $locale = app()->getLocale();
            }

            if (!empty($item) && !$translator->hasForLocale($key, $locale)) {
                $line = LanguagePart::firstOrNew(
                    [
                        "group" => $group,
                        "key" => $item,
                    ],
                    [
                        "text" => [$locale => $default],
                    ]
                );

                $reload = true;
                if ($line->exists && !$line->hasLocale($locale)) {
                    $line->setTranslation($locale, $default)->save();
                } elseif (!$line->exists) {
                    $line->save();
                } else {
                    $reload = false;
                }

                if ($reload) {
                    $translator->setLoaded([]);
                    $translator->load($namespace, $group, $locale);
                }
            }
        }
    }
}
