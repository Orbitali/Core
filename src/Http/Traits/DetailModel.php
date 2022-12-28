<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\DetailCollection;

trait DetailModel
{
    public function newCollection(array $models = [])
    {
        $debug = debug_backtrace(true, 6);
        if ($debug[1]["function"] == "initRelation") {
            $model = array_values($debug[1]["args"][0])[0];
            $method = $debug[1]["args"][1];
            $object = $model->$method(); //OK
        } elseif ($debug[1]["function"] == "getRelationValue") {
            $model = array_values($debug[5]["args"][0])[0];
            $method = $debug[5]["args"][1];
            $object = $model->$method(); //OK
        } elseif ($debug[1]["function"] == "get") {
            $object = $debug[2]["object"]; //OK
        } elseif ($debug[1]["function"] == "hydrate") {
            $object = $debug[4]["object"]; //OK
        } else {
            $object = null;
        }

        return new DetailCollection($models, $object);
    }
}
