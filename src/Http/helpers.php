<?php

if (!function_exists('ntrans')) {
    /**
     * Translate the given message.
     *
     * @param  string $key
     * @param  string $default
     * @param  array $replace
     * @param  string $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function ntrans($key = null, $default = null, $replace = [], $locale = null)
    {
        if (is_null($key)) {
            return app('translator');
        }

        $keys = explode('.', $key);
        if (count($keys) == 1) {
            $keys = array_prepend($keys, "native");
            $key = implode('.', $keys);
        }

        if (!app(Illuminate\Contracts\Translation\Translator::class)->has($key, $locale)) {
            \Orbitali\Http\Models\LanguagePart::create([
                'group' => array_shift($keys),
                'key' => implode('.', $keys),
                'text' => [app("app")->getLocale() => $default],
            ]);
        }

        return app('translator')->trans($key, $replace, $locale);

    }
}

if (!function_exists('ntrans_choice')) {
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
    function ntrans_choice($key, $default, $number, array $replace = [], $locale = null)
    {
        $keys = explode('.', $key);
        if (count($keys) == 1) {
            $keys = array_prepend($keys, "native");
            $key = implode('.', $keys);
        }

        if (!app(Illuminate\Contracts\Translation\Translator::class)->has($key, $locale)) {
            \Orbitali\Http\Models\LanguagePart::create([
                'group' => array_shift($keys),
                'key' => implode('.', $keys),
                'text' => [app("app")->getLocale() => $default],
            ]);
        }

        return app('translator')->transChoice($key, $number, $replace, $locale);
    }
}

if (!function_exists('n__')) {
    /**
     * Translate the given message.
     *
     * @param  string $key
     * @param  string $default
     * @param  array $replace
     * @param  string $locale
     * @return string|array|null
     */
    function n__($key, $default, $replace = [], $locale = null)
    {
        $keys = explode('.', $key);
        if (count($keys) == 1) {
            $keys = array_prepend($keys, "native");
            $key = implode('.', $keys);
        }

        if (!app(Illuminate\Contracts\Translation\Translator::class)->has($key, $locale)) {
            \Orbitali\Http\Models\LanguagePart::create([
                'group' => array_shift($keys),
                'key' => implode('.', $keys),
                'text' => [app("app")->getLocale() => $default],
            ]);
        }

        return app('translator')->getFromJson($key, $replace, $locale);
    }
}
