<?php

namespace Orbitali\Foundations;
use Orbitali\Http\Models\Url;

class Model extends \Illuminate\Database\Eloquent\Model
{
    const PASSIVE = 0;
    const ACTIVE = 1;
    const DRAFT = 2;
    const PREDRAFT = 3;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        static::addGlobalScope(new StatusScope());
    }

    public static function scopeStatus($query, $status = self::ACTIVE)
    {
        if (is_array($status)) {
            return $query->whereIn("status", $status);
        } else {
            return $query->where("status", $status);
        }
    }

    public static function preCreate($data = [])
    {
        $user = auth()->user();
        if ($user) {
            /** @var \Illuminate\Database\Eloquent\Model $model */
            static::onlyPredraft()
                ->where("user_id", $user->id)
                ->forceDelete();
            $model = new static();
            $model->forceFill(
                ["user_id" => $user->id, "status" => self::PREDRAFT] + $data
            );
            $model->save();
            return $model;
        }
        return false;
    }

    public function touchOwners()
    {
        Url::query()->update(["updated_at" => now()]);
    }
}
