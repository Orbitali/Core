<?php

namespace Orbitali\Http\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

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
        if (!isset($this->text[$locale])) {
            $fallback = config('app.fallback_locale');
            return $this->text[$fallback] ?? null;
        }

        return $this->text[$locale];
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
