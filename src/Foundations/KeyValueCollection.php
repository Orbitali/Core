<?php

namespace Orbitali\Foundations;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Stringable;

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
        $data = $this->firstWhere("key", $name);
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

    /**
     * Get the relationships of the entities being queued.
     *
     * @return array
     */
    public function getQueueableRelations()
    {
        if ($this->isEmpty()) {
            return [];
        }

        $relations = $this->map(function ($i) {
            return $i->getQueueableRelations();
        })->all();

        if (count($relations) === 0 || $relations === [[]]) {
            return [];
        } elseif (count($relations) === 1) {
            return reset($relations);
        } else {
            return array_intersect(...array_values($relations));
        }
    }

    public function toArray(){
        $map = function($item) {
            if ($item->value instanceof Arrayable) {
                return [ $item->key => $item->value->toArray() ];
            } elseif ($item->value instanceof Stringable) {
                return [ $item->key => $item->value->__toString() ];
            } else {
                return [ $item->key => $item->value ];
            }
        };
        return $this->mapWithKeys($map)->toArray();
    }
}
