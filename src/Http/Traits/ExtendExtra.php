<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Database\Eloquent\Collection;

trait ExtendExtra
{
    public function __get($key)
    {
        if ($attribute = $this->getAttribute($key)) {
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
