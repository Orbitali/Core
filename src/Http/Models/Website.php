<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;

class Website extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra, BaseModel;

    protected $guarded = [];
    protected $table = "websites";
    protected $fillable = [
        "id",
        "domain",
        "ssl",
        "user_id",
        "status",
        "redirect_id",
        "created_at",
        "updated_at",
        "deleted_at",
    ];
    protected $casts = [
        "domain" => "string",
        "ssl" => "boolean",
    ];

    public function urls()
    {
        return $this->hasMany(Url::class);
    }

    public function nodes()
    {
        return $this->hasMany(Node::class);
    }

    public function extras()
    {
        return $this->hasMany(WebsiteExtra::class);
    }

    public function redirect()
    {
        return $this->belongsTo(Website::class, "redirect_id");
    }

    public function detail()
    {
        $localization = [
                    "language" => orbitali("language"),
                    "country" => orbitali("country"),
        ];
        return $this->hasOne(WebsiteDetail::class)
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
        return $this->hasMany(WebsiteDetail::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
