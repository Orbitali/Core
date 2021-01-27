<?php

namespace Orbitali\Http\Traits;

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
                foreach ($value as $language_country => $vals) {
                    $detail = $this->details()->firstOrNew(
                        Structure::languageCountryParserForWhere(
                            $language_country
                        )
                    );
                    $detail->save();
                    $detail->fillWithExtra($vals);
                }
            } elseif (
                $key == "categories" &&
                method_exists($this, "categories")
            ) {
                if (!is_array($value)) {
                    $value = [$value];
                }
                $this->categories()->sync($value);
            } else {
                if (is_a($value, UploadedFile::class)) {
                    $value = $value->storePubliclyAs(
                        date("Y/m"),
                        time() . "_" . $value->getClientOriginalName(),
                        ["disk" => "public"]
                    );
                } elseif (
                    is_array($value) &&
                    is_a(Arr::first($value), UploadedFile::class)
                ) {
                    $new_val = [];
                    /** @var UploadedFile $file */
                    foreach ($value as $file) {
                        $new_val[] = $file->storePubliclyAs(
                            date("Y/m"),
                            time() . "_" . $file->getClientOriginalName(),
                            ["disk" => "public"]
                        );
                    }
                    $value = $new_val;
                }

                $this->extras->__set($key, $value);
            }
        }
        $this->save();
    }
}
