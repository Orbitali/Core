<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Structure extends Model
{
    use SoftDeletes, Cacheable;

    public $timestamps = false;
    protected $table = "structures";
    protected $guarded = [];
    protected $casts = ["data" => "json"];
    public static $withoutExtra = [
        "id",
        "model_type",
        "model_id",
        "mode",
        "data",
        "deleted_at",
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function getColumnsAttribute()
    {
        $data = collect();
        $expander = function ($datum) use (&$data, &$expander) {
            if (!isset($datum[":children"])) {
                $data[] = $datum;
            } else {
                array_walk($datum[":children"], $expander);
            }
        };
        collect($this->data)->each($expander);
        return $data
            ->map(function ($datum) {
                if (isset($datum[":show-on-list"]) && $datum[":show-on-list"]) {
                    $titleKey = implode(".", [
                        "panel",
                        $this->model_type,
                        $this->model_id,
                        $this->mode,
                        Str::snake($datum["title"]),
                    ]);
                    return [
                        "name" =>
                            $datum[":show-on-list-prefix"] . $datum["name"],
                        "order" => $datum[":show-on-list-order"],
                        "title" => $datum[":show-on-list-empty-header"]
                            ? ""
                            : trans([$titleKey, $datum["title"]]),
                    ];
                }
            })
            ->filter()
            ->sortBy("order");
    }
}
