<?php

namespace Orbitali\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

trait ExtendExtra
{
    public function __get($key)
    {
        return parent::__get($key) ?? $this->extras->$key;
    }

    public function __set($key, $value)
    {
        return in_array($key, $this->withoutExtra)
            ? parent::__set($key, $value)
            : $this->extras->__set($key, $value);
    }

    public function __isset($name)
    {
        return parent::__isset($name) ?:
            $this->extras->where("key", $name)->isNotEmpty();
    }

    /**
     * @param $data
     */
    public function fillWithExtra($data)
    {
        $this->forceFill(Arr::only($data, $this->withoutExtra));
        $extras = Arr::except(
            $data,
            array_merge(["_token", "_method"], $this->withoutExtra)
        );
        foreach ($extras as $key => $value) {
            if ($key == "details" && method_exists($this, "details")) {
                $this->fillDetails($value);
            } elseif (
                method_exists($this, $key) &&
                is_a($morph = $this->{$key}(), BelongsToMany::class)
            ) {
                $morph->sync(Arr::wrap($value));
            } else {
                $this->fillUploadedFiles($value);
                $this->extras->__set($key, $value);
            }
        }
        $this->save();
    }

    private function fillDetails(&$value)
    {
        foreach ($value as $language_country => $vals) {
            $language_country = Structure::languageCountryParserForWhere(
                $language_country
            );

            $this->details()
                ->firstOrCreate($language_country)
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
