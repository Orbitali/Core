<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Database\Eloquent\Collection;

trait KeyValueModel
{
    public function getCasts()
    {
        $cast = ["value" => "json", "key" => "string"];
        if ($this->getIncrementing()) {
            return array_merge(
                [$this->getKeyName() => $this->getKeyType()],
                $cast
            );
        }

        return $cast;
    }

    public function toArray()
    {
        return [$this->key => $this->value];
    }

    public function newCollection(array $models = [])
    {
        $debug = debug_backtrace(true);
        if ($debug[1]["function"] == "initRelation") {
            $model = $debug[1]["args"][0][0];
            $method = $debug[1]["args"][1];
            $object = $model->$method(); //OK
        } elseif ($debug[1]["function"] == "getRelationValue") {
            $model = $debug[5]["args"][0][0];
            $method = $debug[5]["args"][1];
            $object = $model->$method(); //OK
        } elseif ($debug[1]["function"] == "get") {
            $object = $debug[2]["object"]; //OK
        } elseif ($debug[1]["function"] == "hydrate") {
            $object = $debug[4]["object"]; //OK
        } else {
            $object = null;
        }

        return $object === null
            ? new Collection($models)
            : new KeyValueCollection($models, $object);
    }
}
