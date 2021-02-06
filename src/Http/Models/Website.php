<?php

namespace Orbitali\Http\Models;

use Orbitali\Foundations\Model;
use Orbitali\Http\Traits\Cacheable;
use Orbitali\Http\Traits\ExtendExtra;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orbitali\Foundations\Helpers\Relation;

class Website extends Model
{
    use SoftDeletes, Cacheable, ExtendExtra;

    protected $guarded = [];
    protected $table = "websites";
    protected $withoutExtra = [
        "id",
        "domain",
        "ssl",
        "user_id",
        "status",
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

    public function detail()
    {
        return $this->hasOne(WebsiteDetail::class)
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
        return $this->hasMany(WebsiteDetail::class)->whereIn(
            "language",
            orbitali("website")->languages
        );
    }
}
