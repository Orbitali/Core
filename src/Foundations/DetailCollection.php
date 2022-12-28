<?php

namespace Orbitali\Foundations;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Stringable;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Support\HigherOrderCollectionProxy;
use Illuminate\Database\Eloquent\Model;

class DetailCollection extends Collection implements Arrayable
{
    private $morph;
    public function __construct($items = [], $morph = null)
    {
        $this->morph = $morph;
        parent::__construct($items);
    }

    public function __isset($name)
    {
        $name = Structure::languageCountryParserForWhere($name);
        $model = \collect($name)->reduce(function ($curent, $value, $key) { return $curent->where($key, $value); }, $this);
        return $model ->isNotEmpty();
    }

    /**
     * get stored Key Value pair inside of eloquent model
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (! in_array($name, static::$proxies)) {
            $name = Structure::languageCountryParserForWhere($name);
            $model = \collect($name)->reduce(function ($curent, $value, $key) { return $curent->where($key, $value); }, $this)->first();
            if($model == null){
                $model = $this->morph->firstOrNew($name);
                $this->add($model);
            }
            return $model;
        }

        return new HigherOrderCollectionProxy($this, $name);
    }

    public function toArray() {
        $map = function($item) {
            $key = $item->country ? $item->language."|".$item->country : $item->language;
            if ($item->value instanceof Arrayable || $item->value instanceof Model) {
                return [ $key => $item->toArray() ];
            } elseif ( $item->value instanceof Stringable) {
                return [ $key => $item->__toString() ];
            } else {
                return [ $key => $item->toArray() ];
            }
        };
        return $this->mapWithKeys($map)->toArray();
    }
}
