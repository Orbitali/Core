<?php

namespace Orbitali\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LanguagePart extends Model
{
    /** @var array */
    public $translatable = ['text'];

    /** @var array */
    public $guarded = ['id'];

    /** @var array */
    protected $casts = ['text' => 'array'];

    public static function boot()
    {
        parent::boot();
        static::saved(function (LanguagePart $languagePart) {
            $languagePart->flushGroupCache();
        });
        static::deleted(function (LanguagePart $languagePart) {
            $languagePart->flushGroupCache();
        });
    }

    public static function getTranslationsForGroup(string $locale, string $group): array
    {
        return Cache::rememberForever(static::getCacheKey($group, $locale), function () use ($group, $locale) {
            return static::query()
                    ->where('group', $group)
                    ->get()
                    ->reduce(function ($lines, LanguagePart $languageLine) use ($locale) {
                        $translation = $languageLine->getTranslation($locale);
                        if ($translation !== null) {
                            array_set($lines, $languageLine->key, $translation);
                        }
                        return $lines;
                    }) ?? [];
        });
    }

    public static function getCacheKey(string $group, string $locale): string
    {
        return "orbitali.cache.translation.{$group}.{$locale}";
    }

    /**
     * @param string $locale
     *
     * @return string
     */
    public function getTranslation(string $locale): ?string
    {
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
}
