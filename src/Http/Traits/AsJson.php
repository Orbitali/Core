<?php

namespace Orbitali\Http\Traits;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;

class AsJson implements Castable
{
    /**
     * Get the caster class to use when casting from / to this cast target.
     *
     * @param  array  $arguments
     * @return object|string
     */
    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes {
            public function get($model, $key, $value, $attributes)
            {
                if (!isset($attributes[$key])) {
                    return null;
                }
                $value = json_decode($attributes[$key], true);
                if (is_array($value)) {
                    return new Collection($value);
                } elseif (is_numeric($value)) {
                    return $value;
                } else {
                    return new Stringable($value);
                }
            }

            public function set($model, $key, $value, $attributes)
            {
                if ($value instanceof Collection) {
                    return [$key => $value->sortKeys()->toJson()];
                }
                return [$key => json_encode($value)];
            }
        };
    }
}