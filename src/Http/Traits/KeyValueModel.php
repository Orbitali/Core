<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait KeyValueModel
{
    public function newCollection(array $models = [])
    {
        $object = array_first(debug_backtrace(true), function ($trace) {
            return isset($trace['class'])
                && $trace['class'] == Builder::class
                && (
                    substr($trace['function'], 0, 3) == "get"
                    || $trace['function'] == "eagerLoadRelation"
                );
        })["object"];
        return $object === null ? new Collection($models) : new KeyValueCollection($models, $object);
    }
}
