<?php

namespace Orbitali\Http\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Orbitali\Foundations\KeyValueCollection;

trait ExtendExtra
{
    protected static function bootExtendExtra()
    {
        static::preventAccessingMissingAttributes(true);
        static::handleMissingAttributeViolationUsing(function($item, $key){
            if($item->isRelation("extras")){
                return $item->extras->$key;
            } else if ($item->hasGetMutator("extras")) {
                return $item->mutateAttribute("extras", null)->$key;
            }
            return null;
        });
        static::preventSilentlyDiscardingAttributes(true);
        static::handleDiscardedAttributeViolationUsing(function($item, $keys){
            $attributes = debug_backtrace(true,3)[2]["args"][0];
            $extras = array_intersect_key($attributes, array_flip($keys));

            foreach ($extras as $key => $value) {
                if ($key == "details" && method_exists($item, "details")) {
                    foreach ($value as $language_country => $vals) {
                        $item->details->$language_country->fill($vals);
                    }
                } elseif ($item->isRelation($key)) {
                    $morph = $item->{$key}();
                    if (is_a($morph, BelongsToMany::class)) {
                        $morph->sync(Arr::wrap($value));
                    } elseif (is_a($morph, BelongsTo::class)) {
                        $morph->associate($value);
                    } elseif (is_a($morph, HasOne::class)) {
                        $morph->initRelation([$item],$key);
                        $item->$key->fill($value);
                    } elseif (is_a($morph, HasMany::class)) {
                        $item->$key = $morph->makeMany($value);
                    } else {
                        throw new UnexpectedValueException(
                            "Relation type is not supported"
                        );
                    }
                } else {
                    static::fillUploadedFiles($value);
                    $item->$key = $value;
                }
            }
        });
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if ($this->hasSetMutator($key)) {
            return $this->setMutatedAttributeValue($key, $value);
        } elseif ($this->isRelation($key)) {
            if($value instanceof Collection || $value instanceof Model){
                return $this->setRelation($key, $value);
            }
            if(static::isUnguarded()){
                if(!$this->relationLoaded($key)){
                    $this->$key()->initRelation([$this], $key);
                }
            }

            $rel = $this->$key;
            if($rel instanceof Model){
                $rel->fill($value);
            } elseif ($rel instanceof KeyValueCollection && Arr::accessible($value)){
                foreach($value as $k => $v){
                    $rel->$k = $v;
                }
            } elseif($rel instanceof Collection && Arr::accessible($value)) {
                if(static::isUnguarded()){
                    foreach($value as $val){
                        $data = $this->$key()->make($val);
                        $rel->add($data);
                    }
                }
                // TODO: Contorol edilecek
            } else {
                clock($this,$key,$value);
                throw new UnexpectedValueException(
                    "Relation type is not supported"
                );
            }
            return $this;
        } elseif (!in_array($key, $this->getFillable())) {
            return $this->setAttribute("extras", [$key=>$value]);
        }

        return parent::setAttribute($key, $value);
    }

    public function relationsToArray()
    {
        $attributes = parent::relationsToArray();
        $extras = $attributes["extras"] ?? [];
        unset($attributes["extras"]);
        return array_merge($attributes, $extras);
    }

    public function push()
    {
        if (!$this->save()) {
            return false;
        }

        foreach ($this->relations as $key => $models) {
            if($models instanceof Pivot){
                $models->save();
                continue;
            }
            $models = Collection::wrap($models)->filter();
            $foreignKeySetter = function (&$model) {};
            $relation = $this->$key();
            if ($relation instanceof HasOneOrMany) {
                $foreignKey = $relation->getForeignKeyName();
                $localKey = $relation->getParentKey();
                $foreignKeySetter = function (&$model) use (
                    $foreignKey,
                    $localKey
                ) {
                    $model->$foreignKey = $localKey;
                };
            } elseif ($relation instanceof BelongsToMany || $relation instanceof BelongsTo) {
                // nothing to do
            } else {
                throw new UnexpectedValueException(
                    "Relation type is not supported"
                );
            }

            foreach ($models as $model) {
                $foreignKeySetter($model);
                if (!$model->push()) {
                    return false;
                }
            }
        }
        return true;
    }

    static function fillUploadedFiles(&$value)
    {
        if (is_a($value, UploadedFile::class)) {
            $value = Arr::wrap($value);
        }

        if (
            !(Arr::accessible($value) && is_a(Arr::first($value), UploadedFile::class))
        ) {
            return;
        }

        function fileMapper(UploadedFile $file)
        {
            return $file->storePubliclyAs(
                date("Y/m"),
                $file->hashName(),
                ["disk" => "public"]
            );
        }
        $value = array_map("fileMapper", $value);
    }
}
