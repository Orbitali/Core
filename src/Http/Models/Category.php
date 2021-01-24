<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Model;
use Orbitali\Foundations\Nestedset\NodeTrait;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;

class Category extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra, NodeTrait;

    protected $table = "categories";
    protected $guarded = [];
    protected $withoutExtra = [
        "id",
        "node_id",
        "lft",
        "rgt",
        "category_id",
        "user_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function getParentIdName()
    {
        return "category_id";
    }

    public function newNestedSetQuery($table = null)
    {
        $builder = $this->withTrashed()->withPredraft();

        return $this->applyNestedSetScope($builder, $table);
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        return $this->hasManyThrough(
            Url::class,
            CategoryDetail::class,
            null,
            "model_id"
        )->where("model_type", Relation::relationFinder(CategoryDetail::class));
    }

    public function extras()
    {
        return $this->hasMany(CategoryExtra::class);
    }

    public function detail()
    {
        return $this->hasOne(CategoryDetail::class)
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
        return $this->hasMany(CategoryDetail::class);
    }

    public function structure()
    {
        return $this->morphOne(Structure::class, "model");
    }
}
