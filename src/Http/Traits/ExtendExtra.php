<?php

namespace Orbitali\Http\Traits;


use Orbitali\Foundations\Helpers\Structure;
use Illuminate\Http\UploadedFile;

trait ExtendExtra
{
    public function __get($key)
    {
        return parent::__get($key) ?? (in_array($key, $this->withoutExtra) ? null : $this->extras->$key);
    }

    public function __set($key, $value)
    {
        return in_array($key, $this->withoutExtra) ? parent::__set($key, $value) : $this->extras->__set($key, $value);
    }

    public function __isset($name)
    {
        return parent::__isset($name) ?? (in_array($name, $this->withoutExtra) ? false : $this->extras->__isset($name));
    }

    /**
     * @param $data
     */
    public function fillWithExtra($data)
    {
        $this->forceFill(array_only($data, $this->withoutExtra));
        $extras = array_except($data, array_merge(['_token', '_method'], $this->withoutExtra));
        foreach ($extras as $key => $value) {
            if ($key == "details" && method_exists($this, "details")) {
                foreach ($value as $language_country => $vals) {
                    $detail = $this->details()->firstOrCreate(Structure::languageCountryParserForWhere($language_country));
                    $detail->fillWithExtra($vals);
                }
            } else {

                if (is_a($value, UploadedFile::class)) {
                    $value = $value->storePubliclyAs(date("Y/m"), time() . "_" . $value->getClientOriginalName(), ["disk" => "public"]);
                } else if (is_array($value) && is_a(array_first($value), UploadedFile::class)) {
                    $new_val = [];
                    /** @var UploadedFile $file */
                    foreach ($value as $file) {
                        $new_val[] = $file->storePubliclyAs(date("Y/m"), time() . "_" . $file->getClientOriginalName(), ["disk" => "public"]);
                    }
                    $value = $new_val;
                }

                $this->extras->__set($key, $value);
            }
        }
        $this->save();
    }
}
