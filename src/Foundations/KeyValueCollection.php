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
        $model = $this->where('key', $name)->first();
        return $model ? $model->value : null;
    }

    /**
     * set stored Key Value pair inside of eloquent model
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (is_array($value) && ($new_val = json_encode($value)) !== false) {
            $value = $new_val;
        }

        if ($data = $this->where('key', $name)->first()) {
            if ($data->value != $value) {
                $data->value = $value;
                $data->update();
            }
            return;
        }

        $model = (clone($this->getResultsObject))
            ->firstOrCreate(["key" => $name], ["value" => $value]);
        if ($model->exists && $model->value != $value) {
            $model->value = $value;
            $model->update();
        }

    }

}
