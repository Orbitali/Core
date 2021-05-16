<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
