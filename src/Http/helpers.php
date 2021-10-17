<?php

if (!function_exists("trans")) {
    /**
     * Translate the given message.
     *
     * @param  string|array $key
     * @param  array $replace
     * @param  string $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null)
    {
        if ($key === null) {
            return app("translator");
        }
        \Orbitali\Foundations\Helpers\Translate::key_split_and_save_for_trans(
            $key,
            $locale
        );
        return app("translator")->get($key, $replace, $locale);
    }
}

if (!function_exists("trans_choice")) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string|array $key
     * @param  int|array|\Countable $number
     * @param  array $replace
     * @param  string $locale
     * @return string
     */
    function trans_choice($key, $number, array $replace = [], $locale = null)
    {
        \Orbitali\Foundations\Helpers\Translate::key_split_and_save_for_trans(
            $key,
            $locale
        );
        return app("translator")->choice($key, $number, $replace, $locale);
    }
}

if (!function_exists("__")) {
    /**
     * Translate the given message.
     *
     * @param  string|array $key
     * @param  array $replace
     * @param  string $locale
     * @return string|array|null
     */
    function __($key, $replace = [], $locale = null)
    {
        \Orbitali\Foundations\Helpers\Translate::key_split_and_save_for_trans(
            $key,
            $locale
        );
        return app("translator")->get($key, $replace, $locale);
    }
}

if (!function_exists("orbitali")) {
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
            return app("Orbitali");
        } elseif (count($args) == 2) {
            return app("Orbitali")->{$args[0]} = $args[1];
        } elseif (is_string($args[0])) {
            return app("Orbitali")->{$args[0]};
        }
    }
}

if (!function_exists("html")) {
    /**
     * @return \Orbitali\Foundations\Html\Html
     */
    function html()
    {
        return app(\Orbitali\Foundations\Html\Html::class);
    }
}

if (!function_exists("image")) {
    /**
     * @return \Orbitali\Foundations\ImageClosure
     */
    function image($path)
    {
        return new \Orbitali\Foundations\ImageClosure($path);
    }
}

if (!function_exists("gravatar")) {
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
    function gravatar(
        $email,
        $s = 80,
        $d = "mm",
        $r = "g",
        $img = false,
        $atts = []
    ) {
        $url = "//www.gravatar.com/avatar/";
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= " " . $key . '="' . $val . '"';
            }
            $url .= " />";
        }

        return $url;
    }
}

if (!function_exists("human_filesize")) {
    function human_filesize($bytes, $dec = 2)
    {
        $size = ["B", "kB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) .
            @$size[$factor];
    }
}

if (!function_exists("has_shell_access")) {
    function has_shell_access()
    {
        if (!is_callable("shell_exec")) {
            return false;
        }
        $disabled_functions = ini_get("disable_functions");
        return stripos($disabled_functions, "shell_exec") === false;
    }
}
