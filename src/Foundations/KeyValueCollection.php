<?php

namespace Orbitali\Foundations;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Stringable;
use Illuminate\Database\Eloquent\Model;

class KeyValueCollection extends Collection implements Arrayable
{
    private $getResultsObject;

    public function __construct($items = [], $object = null)
    {
        $this->getResultsObject = $object;
        parent::__construct($items);
    }

    /**
     * get stored Key Value pair inside of eloquent model
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->firstWhere("key", $name)?->value;
    }

    public function __isset($name)
    {
        return $this->where("key", $name)->isNotEmpty();
    }

    /**
     * set stored Key Value pair inside of eloquent model
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if(Model::isUnguarded()){
            $data = $this->getResultsObject->make(["key" => $name,"value" => $value]);
            $this->add($data);
        } else {
            $data = $this->firstWhere("key", $name);
        }

        if ($data) {
            if ($data->value != $value) {
                $data->value = $value;
            }
            return;
        }

        $data = $this->getResultsObject->firstOrNew(
            ["key" => $name],
            ["value" => $value]
        );
        if ($data->exists && $data->value != $value) {
            $data->value = $value;
        }
        $this->add($data);
    }

    public function toArray(){
        $result = [];
        foreach ($this->items as $value) {
            if ($value->value instanceof Arrayable) {
                 $result[$value->key] = $value->value->toArray();
            } elseif ($value->value instanceof Stringable) {
                 $result[$value->key] = $value->value->__toString();
            } else {
                 $result[$value->key] = $value->value;
            }
        }
        return $result;
    }
}
