<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Url extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = "urls";
    public static $withoutExtra = [
        "id",
        "website_id",
        "url",
        "model_type",
        "model_id",
        "type",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function model()
    {
        return $this->morphTo();
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function redirects()
    {
        return $this->morphMany(self::class, "model");
    }

    public function __toString()
    {
        return $this->url;
    }
}
