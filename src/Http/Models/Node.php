<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;

class Node extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra, BaseModel;

    protected $table = "nodes";
    protected $guarded = [];
    protected $fillable = [
        "id",
        "website_id",
        "type",
        "single",
        "user_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    protected $casts = [];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function urls()
    {
        $default = ["model_type" => Relation::relationFinder(NodeDetail::class)];
        return $this->hasManyThrough(Url::class, NodeDetail::class, null, "model_id")->where($default)->withDefault($default);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function extras()
    {
        return $this->hasMany(NodeExtra::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function detail()
    {
        $localization = [
            "language" => orbitali("language"),
            "country" => orbitali("country"),
        ];
        return $this->hasOne(NodeDetail::class)
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
        return $this->hasMany(NodeDetail::class);
    }

    public function forms()
    {
        return $this->morphToMany(Form::class, "model", "form_pivots");
    }

    public function getNodeAttribute()
    {
        return $this;
    }
}
