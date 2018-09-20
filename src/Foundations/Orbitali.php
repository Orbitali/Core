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
     * @var array
     */
    protected $parsedUrl;

    /**
     * Orbitali constructor.
     */
    public function __construct()
    {
        $this->request = Request::instance();
        $this->parsedUrl = parse_url($this->request->fullUrl());
        \Debugbar::info($this, app()->getLocale());
    }

    public function captureRequest()
    {
        //TODO: capture url
        //TODO: redirect
        $this->unParseUrl();
    }

    private function unParseUrl()
    {
        $scheme = isset($this->parsedUrl['scheme']) ? $this->parsedUrl['scheme'] . '://' : '';
        $host = isset($this->parsedUrl['host']) ? $this->parsedUrl['host'] : '';
        $port = isset($this->parsedUrl['port']) ? ':' . $this->parsedUrl['port'] : '';
        $user = isset($this->parsedUrl['user']) ? $this->parsedUrl['user'] : '';
        $pass = isset($this->parsedUrl['pass']) ? ':' . $this->parsedUrl['pass'] : '';
        $pass = ($user || $pass) ? "$pass@" : '';
        $path = isset($this->parsedUrl['path']) ? $this->parsedUrl['path'] : '';
        $query = isset($this->parsedUrl['query']) ? '?' . $this->parsedUrl['query'] : '';
        $fragment = isset($this->parsedUrl['fragment']) ? '#' . $this->parsedUrl['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }

    public function __debugInfo()
    {
        //private $Varialbe -> \x00Orbitali\Foundations\Orbitali\x00Varialbe
        //protected $view ->  \0*\0view
        return array_except((array)$this,
            [
            ]);
    }
}
