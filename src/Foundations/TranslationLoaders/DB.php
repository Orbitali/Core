<?php

namespace Orbitali\Foundations\TranslationLoaders;

use Orbitali\Http\Models\LanguagePart;

class DB implements TranslationLoader
{
    public function loadTranslations(string $locale, string $group): array
    {
        return $this->getConfiguredModelClass()::getTranslationsForGroup(
            $locale,
            $group
        );
    }

    protected function getConfiguredModelClass(): string
    {
        return LanguagePart::class;
        /*
        $modelClass = config('translation-loader.model');
        if (!is_a(new $modelClass, LanguagePart::class)) {
            throw InvalidConfiguration::invalidModel($modelClass);
        }
        return $modelClass;
        */
    }
}
