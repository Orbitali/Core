<?php

namespace Orbitali\Foundations;

use Illuminate\Database\Eloquent\Collection;

class KeyValueCollection extends Collection
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
        $model = $this->where("key", $name)->first();
        return $model ? $model->value : null;
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
        if ($data = $this->where("key", $name)->first()) {
            if ($data->value != $value) {
                $data->value = $value;
            }
            return;
        }

        $model = $this->getResultsObject->firstOrNew(
            ["key" => $name],
            ["value" => $value]
        );
        if ($model->exists && $model->value != $value) {
            $model->value = $value;
        }
        $this->add($model);
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
}
