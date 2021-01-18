<?php

namespace Orbitali\Foundations;

use Orbitali\Foundations\TranslationLoaders\DB;
use Orbitali\Foundations\TranslationLoaders\TranslationLoader;
use Illuminate\Translation\FileLoader;

class TranslationLoaderManager extends FileLoader
{
    /**
     * Load the messages for the given locale.
     *
     * @param string $locale
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($locale, $group, $namespace = null): array
    {
        $fileTranslations = parent::load($locale, $group, $namespace);

        if ($namespace !== null && $namespace !== "*") {
            return $fileTranslations;
        }

        $loaderTranslations = $this->getTranslationsForTranslationLoaders(
            $locale,
            $group,
            $namespace
        );
        return array_replace_recursive($fileTranslations, $loaderTranslations);
    }

    protected function getTranslationsForTranslationLoaders(
        string $locale,
        string $group,
        string $namespace = null
    ): array {
        return collect(DB::class)
            ->map(function (string $className) {
                return app($className);
            })
            ->mapWithKeys(function (TranslationLoader $translationLoader) use (
                $locale,
                $group,
                $namespace
            ) {
                return $translationLoader->loadTranslations(
                    $locale,
                    $group,
                    $namespace
                );
            })
            ->toArray();
    }
}
