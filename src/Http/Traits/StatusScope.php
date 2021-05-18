<?php

namespace Orbitali\Http\Traits;
use Orbitali\Foundations\StatusScope as StatusScopeClass;

trait StatusScope
{
    protected static function bootStatusScope()
    {
        static::addGlobalScope(new StatusScopeClass());
    }

    public static function scopeStatus(
        $query,
        $status = StatusScopeClass::ACTIVE
    ) {
        if (is_array($status)) {
            return $query->whereIn("status", $status);
        } else {
            return $query->where("status", $status);
        }
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withPredraft()
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->first();
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
                [
                    "user_id" => $user->id,
                    "status" => StatusScopeClass::PREDRAFT,
                ] + $data
            );
            $model->save();
            return $model;
        }
        return false;
    }
}
