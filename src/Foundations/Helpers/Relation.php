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

    public static function groupExpander(
        &$relation,
        $keys = [],
        $keysReplacer = null
    ) {
        function nth($array, $step, $offset = 0)
        {
            $new = [];

            $position = 0;

            foreach ($array as $item) {
                if ($position % $step === $offset) {
                    $new[] = $item;
                }

                $position++;
            }

            return $new;
        }

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
                nth($dataFlatten, $step, $i)
            );
        }
        return $data;
    }
}
