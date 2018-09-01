<?php

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
        if (is_null($key)) {
            return app('translator');
        }

        if (!app(Illuminate\Contracts\Translation\Translator::class)->has($key, $locale)) {
            $keys = explode('.', $key);
            \Orbitali\Http\Models\LanguagePart::create([
                'group' => array_shift($keys),
                'key' => implode('.', $keys),
                'text' => [app("app")->getLocale() => $default],
            ]);
        }

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
        if (!app(Illuminate\Contracts\Translation\Translator::class)->has($key, $locale)) {
            $keys = explode('.', $key);
            \Orbitali\Http\Models\LanguagePart::create([
                'group' => array_shift($keys),
                'key' => implode('.', $keys),
                'text' => [app("app")->getLocale() => $default],
            ]);
        }

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
    function __($key, $default, $replace = [], $locale = null)
    {
        if (!app(Illuminate\Contracts\Translation\Translator::class)->has($key, $locale)) {
            $keys = explode('.', $key);
            \Orbitali\Http\Models\LanguagePart::create([
                'group' => array_shift($keys),
                'key' => implode('.', $keys),
                'text' => [app("app")->getLocale() => $default],
            ]);
        }

        return app('translator')->getFromJson($key, $replace, $locale);
    }
}
