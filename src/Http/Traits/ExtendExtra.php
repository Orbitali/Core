<?php

namespace Orbitali\Http\Traits;


use Orbitali\Foundations\Helpers\Structure;

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
            if ($key == "details" && method_exists($this, "details")) {
                foreach ($value as $language_country => $vals) {
                    $detail = $this->details()->firstOrCreate(Structure::languageCountryParserForWhere($language_country));
                    $detail->fillWithExtra($vals);
                }
            } else {
                $this->extras->__set($key, $value);
            }
        }
        $this->save();
        return redirect(route('panel.website.index'));
    }
}
