<?php

$file = __DIR__ . '/../../../../../app/Http/helpers.php';
if (file_exists($file)) {
    require_once($file);
}

function key_split_and_save_for_trans(&$key, $default, $locale)
{
    if ($default !== null) {
        $keys = explode('.', $key);
        if (count($keys) == 1) {
            $keys = array_prepend($keys, "native");
            $key = implode('.', $keys);
        }

        if ($locale === null) {
            $locale = app()->getLocale();
        }

        if (!app("translator")->hasForLocale($key, $locale)) {
            $line = \Orbitali\Http\Models\LanguagePart::firstOrNew(
                [
                    'group' => array_shift($keys),
                    'key' => implode('.', $keys)
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

if (!function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string $key
     * @param  string $default
     * @param  array $replace
     * @param  string $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $default = null, $replace = [], $locale = null)
    {
        if ($key === null) {
            return app('translator');
        }

        key_split_and_save_for_trans($key, $default, $locale);
        return app('translator')->trans($key, $replace, $locale);

    }
}

if (!function_exists('trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string $key
     * @param  string $default
     * @param  int|array|\Countable $number
     * @param  array $replace
     * @param  string $locale
     * @return string
     */
    function trans_choice($key, $default, $number, array $replace = [], $locale = null)
    {
        key_split_and_save_for_trans($key, $default, $locale);
        return app('translator')->transChoice($key, $number, $replace, $locale);
    }
}

if (!function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param  string $key
     * @param  string $default
     * @param  array $replace
     * @param  string $locale
     * @return string|array|null
     */
    function __($key, $default = null, $replace = [], $locale = null)
    {
        key_split_and_save_for_trans($key, $default, $locale);
        return app('translator')->getFromJson($key, $replace, $locale);
    }
}
