<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Http\Traits\Structure;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;

class Url extends Model
{
    use Cacheable, SoftDeletes, Structure, ExtendExtra;
    protected $guarded = [];
    protected $table = "urls";
    protected $fillable = [
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

    public function extras()
    {
        return $this->hasMany(UrlExtra::class, "url_id");
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

    public function parent()
    {
        return $this->belongsTo(self::class, "model_id", "id", "model");
    }
}
