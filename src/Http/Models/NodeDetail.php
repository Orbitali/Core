<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendDetail;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class NodeDetail extends Model
{
    use Cacheable, ExtendExtra, ExtendDetail;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "node_details";
    protected $touches = ["parent"];
    protected $fillable = [
        "id",
        "node_id",
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
        return $this->belongsTo(Node::class, "node_id");
    }

    public function url()
    {
        return $this->morphOne(Url::class, "model")->where([
            "website_id" => orbitali("website")->id,
            "type" => "original",
        ]);
    }

    public function extras()
    {
        return $this->hasMany(NodeDetailExtra::class);
    }
}
