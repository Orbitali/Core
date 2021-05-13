<?php

namespace Orbitali\Foundations\Helpers;
use Illuminate\Support\Arr;

class Relation
{
    public static function relationFinder($cls)
    {
        return array_search(
            is_string($cls) ? $cls : get_class($cls),
            \Illuminate\Database\Eloquent\Relations\Relation::$morphMap
        );
    }

    static function nth($array, $step, $offset, &$applier)
    {
        $new = [];
        $position = 0;
        foreach ($array as $item) {
            if ($position % $step === $offset) {
                $func = $applier[count($new)] ?? null;
                if(is_null($func)){
                    $new[] = $item;
                } else {
                    $new[] = call_user_func($func,$item);
                }
            }
            $position++;
        }
        return $new;
    }

    public static function groupExpander(
        &$relation,
        $keys = [],
        $keysReplacer = null,
        $applier = [],
    ) {
        if (is_null($keysReplacer)) {
            $keysReplacer = $keys;
        }

        foreach ($keys as $key) {
            $data[$key] = data_get($relation, $key);
        }
        $dataFlatten = Arr::flatten($data, 1);
        $step = count($dataFlatten) / count($keys);
        $data = [];
        for ($i = 0; $i < $step; $i++) {
            $data[] = (object) array_combine(
                $keysReplacer,
                Relation::nth($dataFlatten, $step, $i, $applier)
            );
        }
        return $data;
    }
}
