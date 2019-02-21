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

    public function fillWithExtra($data)
    {
        $this->forceFill(array_only($data, $this->withoutExtra));
        $extras = array_except($data, array_merge(['_token', '_method'], $this->withoutExtra));
        foreach ($extras as $key => $value) {
            $this->extras->__set($key, $value);
        }
        $this->save();
        return redirect(route('panel.website.index'));
    }
}
