<?php

namespace Orbitali\Http\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Contracts\Support\Arrayable;
use Orbitali\Http\Traits\ExtendDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Stringable;

trait ExtendExtra
{
    protected static function bootExtendExtra()
    {
        static::preventAccessingMissingAttributes(true);
        static::handleMissingAttributeViolationUsing(function($item, $key){
            if($item->isRelation("extras")){
                return $item->extras->firstWhere("key", $key)->value ?? null;
            }
            return null;
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
            return $this->setRelation($key, $value);
        } elseif (!$this->isFillable($key)) {
            $data = $this->extras->firstWhere("key", $key);
            if (is_null($data)) {
                $data = $this->extras()->firstOrNew(
                    compact("key"),
                    compact("value")
                );
                $this->extras->add($data);
            }

            if ($data->value != $value) {
                $data->value = $value;
            }

            return $this;
        }
        return parent::setAttribute($key, $value);
    }

    public function relationsToArray()
    {
        $attributes = [];
        foreach ($this->getArrayableRelations() as $key => $value) {
            if ($value instanceof KeyValueCollection) {
                $value->each(function ($item) use (&$attributes) {
                    if ($item->value instanceof Arrayable) {
                        $attributes[$item->key] = $item->value->toArray();
                    } elseif ($item->value instanceof Stringable) {
                        $attributes[$item->key] = $item->value->__toString();
                    } else {
                        $attributes[$item->key] = $item->value;
                    }
                });
            } elseif ($value instanceof Arrayable) {
                $relation = $value->toArray();
            } elseif (is_null($value)) {
                $relation = $value;
            }

            if (static::$snakeAttributes) {
                $key = Str::snake($key);
            }

            if (isset($relation) || is_null($value)) {
                $attributes[$key] = $relation;
            }
            unset($relation);
        }

        return $attributes;
    }

    public function push()
    {
        if (!$this->save()) {
            return false;
        }

        foreach ($this->relations as $key => $models) {
            $relation = $this->$key();
            $models = Collection::wrap($models)->filter();

            $foreignKeySetter = function (&$model) {};
            if ($relation instanceof HasOneOrMany) {
                $foreignKey = $this->$key()->getForeignKeyName();
                $localKey = $this->$key()->getParentKey();
                $foreignKeySetter = function (&$model) use (
                    $foreignKey,
                    $localKey
                ) {
                    $model->$foreignKey = $localKey;
                };
            } elseif ($relation instanceof BelongsToMany) {
                $models->each->save();
                continue;
            } elseif ($relation instanceof BelongsTo) {
                $models->each->save();
                continue;
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

    /**
     * @param $data
     */
    public function fillWithExtra($data)
    {
        $this->fill($data);
        $extras = Arr::except(
            $data,
            array_merge(["_token", "_method"], $this->fillable)
        );
        foreach ($extras as $key => $value) {
            if ($key == "details" && method_exists($this, "details")) {
                $this->fillDetails($value);
            } elseif (
                method_exists($this, $key) &&
                is_a($morph = $this->{$key}(), Relation::class)
            ) {
                if (is_a($morph, BelongsToMany::class)) {
                    $morph->sync(Arr::wrap($value));
                } elseif (is_a($morph, BelongsTo::class)) {
                    $morph->associate($value);
                } else {
                    throw new UnexpectedValueException(
                        "Relation type is not supported"
                    );
                }
            } else {
                $this->fillUploadedFiles($value);
                $this->$key = $value;
            }
        }
        $this->push();
    }

    private function fillDetails(&$value)
    {
        foreach ($value as $language_country => $vals) {
            $language_country = Structure::languageCountryParserForWhere(
                $language_country
            );

            $this->details()
                ->firstOrNew($language_country)
                ->fillWithExtra($vals);
        }
    }

    private function fillUploadedFiles(&$value)
    {
        if (is_a($value, UploadedFile::class)) {
            $value = [$value];
        }

        if (
            !(is_array($value) && is_a(Arr::first($value), UploadedFile::class))
        ) {
            return;
        }

        function fileMapper($file)
        {
            return $file->storePubliclyAs(
                date("Y/m"),
                time() . "_" . $file->getClientOriginalName(),
                ["disk" => "public"]
            );
        }
        $value = array_map("fileMapper", $value);
    }
}