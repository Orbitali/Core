<?php

namespace Orbitali\Foundations;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Traits\Macroable;

class Orbitali
{
    use Macroable;

    private $data;
    private $booted = false;

    /**
     * Orbitali constructor.
     */
    public function __construct()
    {

    }

    public function boot()
    {
        if ($this->booted) return;
        $this->booted = true;
        $this->request = Request::instance();
        $this->parsedUrl = parse_url($this->request->fullUrl());

        /*
        $cart = clock()->userData('Cart');
        $cart->counters([
            'Products' => 3,
            'Value' => '949.80€'
        ])->title("test");

        $cart->table('Products', [
            [ 'Product' => 'iPad Pro 10.5" 256G Silver', 'Price' => '849 €' ],
            [ 'Product' => 'Smart Cover iPad Pro 10.5 White', 'Price' => '61.90 €' ],
            [ 'Product' => 'Apple Lightning to USB 3 Camera Adapter', 'Price' => '38.90 €' ]
        ]);

        clock($this);
        */
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

    public function __get($varName)
    {

        if (!array_key_exists($varName, $this->data)) {
            throw new Exception('.....');
        } else return $this->data[$varName];

    }

    public function __set($varName, $value)
    {
        $this->data[$varName] = $value;
    }

    public function __debugInfo()
    {
        //private $Varialbe -> \x00Orbitali\Foundations\Orbitali\x00Varialbe
        //protected $view ->  \0*\0view
        return $this->data;// array_except((array)$this, []);
    }
}
