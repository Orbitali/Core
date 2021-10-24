<?php

namespace Orbitali\Http\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Orbitali\Foundations\KeyValueCollection;
use Illuminate\Contracts\Support\Arrayable;

trait ExtendExtra
{
    public function __get($key)
    {
        return parent::__get($key) ?? $this->extras->$key;
    }

    public function __set($key, $value)
    {
        return in_array($key, self::$withoutExtra)
            ? parent::__set($key, $value)
            : $this->extras->__set($key, $value);
    }

    public function __isset($name)
    {
        return parent::__isset($name) ?:
            $this->extras->where("key", $name)->isNotEmpty();
    }

    public function offsetExists($offset)
    {
        return !is_null($this->getAttribute($offset));
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return in_array($offset, self::$withoutExtra)
            ? $this->setAttribute($offset, $value)
            : $this->extras->__set($offset, $value);
    }

    public function relationsToArray()
    {
        $attributes = [];
        foreach ($this->getArrayableRelations() as $key => $value) {
            if ($value instanceof KeyValueCollection) {
                $value->each(function ($item) use (&$attributes) {
                    $attributes[$item->key] = $item->value;
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

    /**
     * @param $data
     */
    public function fillWithExtra($data)
    {
        $this->forceFill(Arr::only($data, self::$withoutExtra));
        $extras = Arr::except(
            $data,
            array_merge(["_token", "_method"], self::$withoutExtra)
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
                $this->extras->__set($key, $value);
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
