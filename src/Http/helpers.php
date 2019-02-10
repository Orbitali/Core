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

if (!function_exists('orbitali')) {
    /**
     * Get / set the specified Orbitali.
     *
     * If an array is passed, we'll assume you want to put to the Orbitali.
     *
     * @param  dynamic  key|key,value|null
     * @return mixed|\Orbitali\Foundations\Orbitali
     *
     */
    function orbitali()
    {
        $args = func_get_args();
        if (empty($args)) {
            return app('Orbitali');
        } else if (isset($args[0]) && isset($args[1])) {
            return app('Orbitali')->{$args[0]} = $args[1];
        } else if (is_string($args[0])) {
            return app('Orbitali')->{$args[0]};
        }
    }
}

if (!function_exists('gravatar')) {

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param int|string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param bool $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    function gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = [])
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }

        return $url;
    }
}
