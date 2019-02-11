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
        //TODO: kontrol edilecek $this normal collection için yapılabilir mi? yada her get sorgu atıyor mu?
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
        $model = $this->getResultsObject->firstOrNew(["key" => $name], ["value" => $value]);
        if ($model->exists && $model->value != $value) {
            $model->value = $value;
            $model->update();
        } else if (!$model->exists) {
            $model->save();
        }
    }

}
