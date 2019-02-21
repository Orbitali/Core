<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Database\Eloquent\Collection;

trait KeyValueModel
{
    public function newCollection(array $models = [])
    {
        $debug = debug_backtrace(true);
        if ($debug[1]["function"] == "initRelation") {
            $model = $debug[1]["args"][0][0];
            $method = $debug[1]["args"][1];
            $object = $model->$method(); //OK
        } else if ($debug[1]["function"] == "getRelationValue") {
            $model = $debug[5]["args"][0][0];
            $method = $debug[5]["args"][1];
            $object = $model->$method(); //OK
        } else if ($debug[1]["function"] == "get") {
            $object = $debug[2]["object"]; //OK
        } else if ($debug[1]["function"] == "hydrate") {
            $object = $debug[4]["object"]; //OK
        } else {
            $object = null;
        }

        return $object === null ? new Collection($models) : new KeyValueCollection($models, $object);
    }
}
