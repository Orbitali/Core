<?php

namespace Orbitali\Http\Traits;


trait ExtendExtra
{
    public function __get($key)
    {
        if ($attribute = parent::__get($key)) {
            return $attribute;
        }
        return $this->extras->$key;
    }

    public function __set($key, $value)
    {
        if (in_array($key, $this->withoutExtra)) {
            return $this->setAttribute($key, $value);
        }
        return $this->extras->__set($key, $value);
    }
}
