<?php

namespace Orbitali\Http\Traits;

use Orbitali\Foundations\Helpers\Relation;
use Orbitali\Http\Models\Structure as StructureModel;
use Orbitali\Http\Models\Page;
use Orbitali\Http\Models\User;
use Orbitali\Http\Models\Category;

trait Structure
{
    public function structure()
    {
        return $this->morphOne(StructureModel::class, "model");
    }

    private $cachedStructure = false;
    public function getStructureAttribute()
    {
        if ($this->cachedStructure) {
            return $this->cachedStructure;
        }
        $relationName = Relation::relationFinder($this);
        $this->cachedStructure = $this->structure()->where("mode", "self");
        if (is_a($this, Page::class) || is_a($this, Category::class)) {
            $this->cachedStructure = $this->cachedStructure->union(
                $this->node->structure()->where("mode", $relationName)
            );
        } elseif (is_a($this, User::class)) {
            $this->cachedStructure = $this->cachedStructure->union(
                orbitali()
                    ->website->structure()
                    ->where("mode", $relationName)
            );
        }
        $this->cachedStructure = $this->cachedStructure->union(
            StructureModel::where([
                "model_type" => $relationName,
                "model_id" => 0,
                "mode" => $relationName,
            ])
        );
        return $this->cachedStructure = $this->cachedStructure->first();
    }
}
