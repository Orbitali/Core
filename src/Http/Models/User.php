<?php

namespace Orbitali\Http\Models;

use Orbitali\Http\Traits\Model as BaseModel;
use Orbitali\Http\Traits\ExtendExtra;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends \App\Models\User
{
    use HasRolesAndAbilities, SoftDeletes, ExtendExtra, BaseModel;

    protected $fillable = [
        "id",
        "name",
        "email",
        "email_verified_at",
        "password",
        "remember_token",
        "user_id",
        "status",
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $hidden = ["password", "remember_token"];

    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, ["user_id", "status"]);
        parent::__construct($attributes);
    }

    public function extras()
    {
        return $this->hasMany(UserExtra::class, "user_id");
    }

    public function urls()
    {
        $default = ["model_type" => Relation::relationFinder(UserDetail::class)];
        return $this->hasManyThrough(
            Url::class,
            UserDetail::class,
            null,
            "model_id"
        )->where($default)->withDefault($default);
    }

    public function detail()
    {
        $localization = [
                    "language" => orbitali("language"),
                    "country" => orbitali("country"),
        ];
        return $this->hasOne(UserDetail::class)
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
        return $this->hasMany(UserDetail::class);
    }
}
