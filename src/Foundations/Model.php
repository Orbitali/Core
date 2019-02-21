<?php

namespace Orbitali\Foundations;

class Model extends \Illuminate\Database\Eloquent\Model
{
    const PASSIVE = 0;
    const ACTIVE = 1;
    const DRAFT = 2;
    const PREDRAFT = 3;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        static::addGlobalScope(new StatusScope);
    }

    public static function preCreate($data = [])
    {
        $user = auth()->user();
        if ($user) {
            /** @var \Illuminate\Database\Eloquent\Model $model */
            $model = static::withPredraft()->firstOrNew(["user_id" => $user->id, "status" => self::PREDRAFT]);
            if ($model->exists) {
                $model->forceDelete();
                $model = new static();
                $model->forceFill(["user_id" => $user->id, "status" => self::PREDRAFT]);
            }
            $model->forceFill($data);
            $model->save();
            return $model;
        }
        return false;
    }
}
