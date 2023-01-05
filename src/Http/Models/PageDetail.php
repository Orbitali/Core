<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendDetail;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    use Cacheable, ExtendExtra, ExtendDetail;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "page_details";
    protected $touches = ["parent"];
    protected $fillable = [
        "id",
        "page_id",
        "language",
        "country",
        "name",
    ];
    protected $casts = [
        "language" => "string",
        "country" => "string",
        "name" => "string",
    ];

    public function parent()
    {
        return $this->belongsTo(Page::class, "page_id");
    }

    public function url()
    {
        $default = [
            "type" => "original",
        ];
        return $this->morphOne(Url::class, "model")->where($default)->withDefault(function($instance, $parent){
            $instance->type = "original";
            $instance->website_id = $parent->parent->node->website_id;
        });
    }

    public function extras()
    {
        return $this->hasMany(PageDetailExtra::class);
    }
}
