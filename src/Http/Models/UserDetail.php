<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendDetail;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use Cacheable, ExtendExtra, ExtendDetail;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = "user_details";
    protected $touches = ["parent"];
    protected $fillable = [
        "id",
        "user_id",
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
        return $this->belongsTo(User::class, "node_id");
    }

    public function url()
    {
        $default = [
            "website_id" => orbitali("website")->id,
            "type" => "original",
        ];
        return $this->morphOne(Url::class, "model")->where($default)->withDefault($default);
    }

    public function extras()
    {
        return $this->hasMany(UserDetailExtra::class);
    }
}
