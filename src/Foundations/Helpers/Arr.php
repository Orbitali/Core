<?php

namespace Orbitali\Foundations\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class Arr
{
    /**
     * Return an array of enabled values. Enabled values are either:
     *     - Keys that have a truthy value;
     *     - Values that don't have keys.
     *
     * Example:
     *
     *     Arr::getToggledValues(['foo' => true, 'bar' => false, 'baz'])
     *     // => ['foo', 'baz']
     *
     * @param mixed $map
     *
     * @return array
     */
    public static function getToggledValues($map)
    {
        return Collection::make($map)
            ->map(function ($condition, $value) {
                if (is_numeric($value)) {
                    return $condition;
                }

                return $condition ? $value : null;
            })
            ->filter()
            ->toArray();
    }

    public static function endWiths($name, $conditions)
    {
        $res = false;
        foreach ($conditions as $condition) {
            $res |= Str::endsWith($name, $condition);
            if ($res) {
                break;
            }
        }
        return $res;
    }

    public static function get($object, $template)
    {
        $regex = preg_match_all('/(\$|@)([\:\w\.]+)/', $template, $out);
        for ($i = 0; $i < $regex; $i++) {
            if ($out[1][$i] == "$") {
                $template = str_replace(
                    $out[0][$i],
                    data_get($object, $out[2][$i], ""),
                    $template
                );
            }
        }
        return $template;
    }
}
