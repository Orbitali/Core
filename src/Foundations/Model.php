<?php

namespace Orbitali\Foundations;
use Orbitali\Http\Models\Url;
use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Http\Models\Structure;
use Orbitali\Http\Models\Node;
use Orbitali\Http\Models\Website;

class Model extends \Illuminate\Database\Eloquent\Model
{
    const PASSIVE = 0;
    const ACTIVE = 1;
    const DRAFT = 2;
    const PREDRAFT = 3;

    protected static function booted()
    {
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

    public function structure()
    {
        return $this->morphOne(Structure::class, "model");
    }

    private $cachedStructure = false;
    public function getStructureAttribute()
    {
        if ($this->cachedStructure) {
            return $this->cachedStructure;
        }
        $this->cachedStructure = $this->structure()->where("self", 1);
        if (!is_a($this, Node::class) && !is_a($this, Website::class)) {
            $this->cachedStructure = $this->cachedStructure->union(
                $this->node->structure()->where("self", 0)
            );
        }
        $this->cachedStructure = $this->cachedStructure->union(
            Structure::where([
                "model_type" => Relation::relationFinder($this),
                "model_id" => 0,
                "self" => 0,
            ])
        );
        return $this->cachedStructure = $this->cachedStructure->first();
    }
}
