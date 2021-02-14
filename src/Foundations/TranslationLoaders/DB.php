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
    }
}
