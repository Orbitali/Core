<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

class LanguagePart extends Model
{
    /** @var array */
    public $translatable = ["text"];

    /** @var array */
    public $guarded = ["id"];
    public $timestamps = false;
    /** @var array */
    protected $casts = ["text" => "array"];

    public static function boot()
    {
        parent::boot();

        $flushGroupCache = function (self $languagePart) {
            $languagePart->flushGroupCache();
        };

        static::saved($flushGroupCache);
        static::deleted($flushGroupCache);
    }

    protected function flushGroupCache()
    {
        foreach ($this->getTranslatedLocales() as $locale) {
            Cache::forget(static::getCacheKey($this->group, $locale));
        }
    }

    protected function getTranslatedLocales(): array
    {
        return array_keys($this->text);
    }

    public static function getCacheKey(string $group, string $locale): string
    {
        return "orbitali.cache.translation.{$group}.{$locale}";
    }

    public static function getTranslationsForGroup(
        string $locale,
        string $group
    ): array {
        return Cache::rememberForever(
            static::getCacheKey($group, $locale),
            function () use ($group, $locale) {
                return static::query()
                    ->where("group", $group)
                    ->get()
                    ->reduce(function ($lines, self $languageLine) use (
                        $group,
                        $locale
                    ) {
                        $translation = $languageLine->getTranslation($locale);

                        if (!is_null($translation)) {
                            if ($group === "*") {
                                // Make a flat array when returning json translations
                                $lines[$languageLine->key] = $translation;
                            } else {
                                // Make a nesetd array when returning normal translations
                                Arr::set(
                                    $lines,
                                    $languageLine->key,
                                    $translation
                                );
                            }
                        }
                        return $lines;
                    }) ?? [];
            }
        );
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getTranslation(string $locale): ?string
    {
        if (!isset($this->text[$locale])) {
            $locale = config("app.fallback_locale");
        }
        return $this->text[$locale] ?? null;
    }

    /**
     * @param string $locale
     * @param string $value
     *
     * @return $this
     */
    public function setTranslation(string $locale, string $value)
    {
        $this->text = array_merge($this->text ?? [], [$locale => $value]);
        return $this;
    }

    /**
     * @param string $locale
     * @return bool
     */
    public function hasLocale($locale): bool
    {
        return isset($this->text[$locale]);
    }
}
