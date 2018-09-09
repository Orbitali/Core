<?php

namespace Orbitali\Foundations;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Traits\Macroable;

class Orbitali
{
    use Macroable;
    /**
     * @var \Illuminate\Http\Request
     */
    public $request;
    /**
     * current language code
     * @var string
     */
    public $language;
    /**
     * current country code
     * @var string|null
     */
    public $country;
    /**
     * @var array
     */
    protected $parsedUrl;
    private $languages = [];
    private $countries = [];

    /**
     * Orbitali constructor.
     */
    public function __construct()
    {
        $this->request = Request::instance();
        $this->parsedUrl = parse_url($this->request->fullUrl());
        $this->captureLocalization();

        dd($this, app()->getLocale());
    }

    public function captureLocalization()
    {
        $this->languages = require __DIR__ . '/../Config/languages.php';
        $this->countries = require __DIR__ . '/../Config/countries.php';
        $localizationCaptureType = config("orbitali.localizationCaptureType");

        if (!is_int($localizationCaptureType) && ($localizationCaptureType = intval($localizationCaptureType)) == 0) {
            $localizationCaptureType = 1;
        }

        if ($localizationCaptureType == 2 && $this->setLocale($this->request->getPreferredLanguage())) {
            return;
        }

        if (in_array($localizationCaptureType, [2, 1]) && $this->setLocale(Request::segment(1, ""))) {
            return;
        }

        // TODO return default site language
        $this->setLocale("tr");
    }

    /**
     * set locale of CRM
     * @param string $locale
     * @return bool
     */
    public function setLocale(string $locale): bool
    {
        if (($locale = $this->checkLocaleExist($locale)) !== false) {
            app()->setLocale($locale);
            return true;
        }
        return false;
    }

    /**
     * Check locale existing in conf
     * @return false|string
     */
    private function checkLocaleExist($locale)
    {
        if (preg_match("/^(?<lang>[a-z|A-Z]{2})([-_](?<country>[a-z|A-Z]{2}))?$/", $locale, $matches)) {

            $language = mb_strtolower($matches["lang"]);
            if (key_exists($language, $this->languages)) {
                $this->language = $language;
            } else {
                return false;
            }

            if (isset($matches["country"])) {
                $country = mb_strtoupper($matches["country"]);
                if (key_exists($country, $this->countries)) {
                    $this->country = $country;
                    return $this->language . '_' . $this->country;
                }
            }

            return $this->language;
        }
        return false;
    }

    /**
     * get locale of CRM
     * @return string
     */
    public function getLocale(): string
    {
        return app()->getLocale();
    }

    public function captureRequest()
    {

    }

    public function __debugInfo()
    {
        //private $Varialbe -> \x00Orbitali\Foundations\Orbitali\x00Varialbe
        //protected $view ->  \0*\0view
        return array_except((array)$this,
            [
                "\x00Orbitali\Foundations\Orbitali\x00languages",
                "\x00Orbitali\Foundations\Orbitali\x00countries",
            ]);
    }


    private function unparse_url($parsed_url)
    {
        $scheme = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass = isset($parsed_url['pass']) ? ':' . $parsed_url['pass'] : '';
        $pass = ($user || $pass) ? "$pass@" : '';
        $path = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }
}
