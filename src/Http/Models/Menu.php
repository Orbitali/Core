<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Foundations\Nestedset\NodeTrait;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra, NodeTrait, BaseModel;

    protected $table = "menus";
    protected $guarded = [];
    protected $fillable = [
        "id",
        "lft",
        "rgt",
        "type",
        "data",
        "menu_id",
        "user_id",
        "website_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public static function boot()
    {
        parent::boot();

        $flushGroupCache = function (self $languagePart) {
            $languagePart->flushGroupCache();
        };

        static::created($flushGroupCache);
        static::updated($flushGroupCache);
        static::deleted($flushGroupCache);
    }

    protected function flushGroupCache()
    {
        foreach ($this->getAncestors(["id"]) as $model) {
            Cache::forget('orbitali.cache.menu_manager.'.$model->id);
        }
    }

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

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function extras()
    {
        return $this->hasMany(MenuExtra::class);
    }

    public function detail()
    {
        $localization = [
                    "language" => orbitali("language"),
                    "country" => orbitali("country"),
        ];
        return $this->hasOne(MenuDetail::class)
            ->where(function ($q) use($localization) {
                $q->where($localization)->orWhere(function ($q) {
                    $q->where([
                        "language" => orbitali("language"),
                        "country" => null,
                    ]);
                });
            })
            ->orderBy("country", "DESC")
            ->withDefault($localization);
    }

    public function details()
    {
        return $this->hasMany(MenuDetail::class);
    }
}
