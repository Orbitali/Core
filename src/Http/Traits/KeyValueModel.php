<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Database\Eloquent\Collection;

trait KeyValueModel
{
    public function newCollection(array $models = [])
    {
        $object = array_first(debug_backtrace(true), function ($trace) {
            return $trace['function'] == "getResults";
        })["object"];
        return $object === null ? new Collection($models) : new KeyValueCollection($models, $object);
    }
}
