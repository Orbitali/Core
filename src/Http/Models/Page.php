<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;

class Page extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra, BaseModel;

    protected $table = "pages";
    protected $guarded = [];
    public static $withoutExtra = [
        "id",
        "node_id",
        "order",
        "user_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        return $this->hasManyThrough(
            Url::class,
            PageDetail::class,
            null,
            "model_id"
        )->where("model_type", Relation::relationFinder(PageDetail::class));
    }

    public function extras()
    {
        return $this->hasMany(PageExtra::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function detail()
    {
        return $this->hasOne(PageDetail::class)
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
        return $this->hasMany(PageDetail::class)->whereIn(
            "language",
            orbitali("website")->languages
        );
    }

    public function forms()
    {
        return $this->morphToMany(Form::class, "model", "form_pivots");
    }
}
