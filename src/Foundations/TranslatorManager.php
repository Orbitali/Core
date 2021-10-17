<?php

namespace Orbitali\Foundations;

use Orbitali\Http\Models\LanguagePart;
use Illuminate\Translation\Translator;
use Illuminate\Support\Arr;

class TranslatorManager extends Translator
{
    /**
     * Get the translation for the given key.
     *
     * @param  string|array  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @param  bool  $fallback
     * @return string|array
     */
    public function get(
        $key,
        array $replace = [],
        $locale = null,
        $fallback = true
    ) {
        $this->key_split_and_save_for_trans($key, $locale);
        return parent::get($key, $replace, $locale, $fallback);
    }

    private function key_split_and_save_for_trans(&$mainKey, $locale)
    {
        if (!is_array($mainKey)) {
            return;
        }

        $default = $mainKey[1];
        $mainKey = $mainKey[0];

        [$namespace, $group, $key] = $this->parseKey($mainKey);

        if (empty($key) || $this->hasForLocale($mainKey, $locale)) {
            return;
        }

        if (empty($locale)) {
            $locale = $this->locale;
        }

        $line = LanguagePart::firstOrNew(compact("group", "key"), [
            "text" => [$locale => $default],
        ]);

        if ($line->exists) {
            $line->setTranslation($locale, $default);
        }
        $line->save();

        Arr::set($this->loaded[$namespace][$group][$locale], $key, $default);
    }
}
