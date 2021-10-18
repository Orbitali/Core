<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Foundations\Nestedset\NodeTrait;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;

class Menu extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra, NodeTrait, BaseModel;

    protected $table = "menus";
    protected $guarded = [];
    public static $withoutExtra = [
        "id",
        "lft",
        "rgt",
        "type",
        "url_id",
        "data",
        "menu_id",
        "user_id",
        "website_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function getParentIdName()
    {
        return "menu_id";
    }

    public function newNestedSetQuery($table = null)
    {
        $builder = $this->withTrashed()->withPredraft();

        return $this->applyNestedSetScope($builder, $table);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function extras()
    {
        return $this->hasMany(MenuExtra::class);
    }

    public function detail()
    {
        return $this->hasOne(MenuDetail::class)
            ->where(function ($q) {
                $q->where([
                    "language" => orbitali("language"),
                    "country" => orbitali("country"),
                ])->orWhere(function ($q) {
                    $q->where([
                        "language" => orbitali("language"),
                        "country" => null,
                    ]);
                });
            })
            ->orderBy("country", "DESC");
    }

    public function details()
    {
        return $this->hasMany(MenuDetail::class)->whereIn(
            "language",
            orbitali("website")->languages
        );
    }
}
