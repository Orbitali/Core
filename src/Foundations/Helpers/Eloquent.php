<?php

namespace Orbitali\Foundations\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Eloquent
{
    public static function queryBuilder(&$query, $columns, $search)
    {
        if (strlen($search) == 0) {
            return;
        }
        $listEntity = $query->getModel();
        $fields = collect($listEntity->getFillable());
        $columns = collect(Arr::wrap($columns));

        $query->where(function ($query) use (
            $columns,
            $listEntity,
            $search,
            &$fields
        ) {
            $query = $columns->reduce(function ($q, $column) use (
                &$fields,
                $listEntity,
                $search
            ) {
                $paths = Str::of($column)->explode(".");
                $count = $paths->count();
                $field = $paths->shift();
                /* Relation */
                if ($count > 1 && method_exists($listEntity, $field)) {
                    $queryResult = $q->orWhereHas($field, function ($q) use (
                        &$paths,
                        $search
                    ) {
                        self::queryBuilder($q, $paths->implode("."), $search);
                    });
                } /* Json */ elseif ($count > 1 && $fields->contains($field)) {
                    $queryResult = $q->orWhere(
                        "$field->" . $paths->implode("->"),
                        "like",
                        "%$search%"
                    );
                } /* Column */ elseif (
                    $fields->contains($field) &&
                    !method_exists(
                        $listEntity,
                        "get" . Str::title($field) . "Attribute"
                    )
                ) {
                    $queryResult = $q->orWhere($field, "like", "%$search%");
                } /* Extras */ elseif (method_exists($listEntity, "extras")) {
                    $queryResult = $q->orWhereHas("extras", function ($q) use (
                        $field,
                        $search
                    ) {
                        $q->where("key", $field)->where(
                            "value",
                            "like",
                            "%$search%"
                        );
                    });
                } else {
                    $queryResult = $q->orWhereRaw("1 != 1");
                }
                return $queryResult;
            },
            $query);
        });
    }
}
