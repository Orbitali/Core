<?php

namespace Orbitali\Foundations\TranslationLoaders;

use Orbitali\Http\Models\LanguagePart;

class Db implements TranslationLoader
{
    public function loadTranslations(string $locale, string $group): array
    {
        $model = $this->getConfiguredModelClass();
        return $model::getTranslationsForGroup($locale, $group);
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
