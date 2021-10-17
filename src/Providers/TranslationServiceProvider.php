<?php

namespace Orbitali\Providers;

use Orbitali\Foundations\TranslationLoaderManager;
use Orbitali\Foundations\TranslatorManager;
use Illuminate\Translation\TranslationServiceProvider as IlluminateTranslationServiceProvider;

class TranslationServiceProvider extends IlluminateTranslationServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();

        $this->app->singleton("translator", function ($app) {
            $loader = $app["translation.loader"];
            $locale = $app["config"]["app.locale"];

            $trans = new TranslatorManager($loader, $locale);
            $trans->setFallback($app["config"]["app.fallback_locale"]);

            return $trans;
        });
    }

    /**
     * Register the translation line loader. This method registers a
     * `TranslationLoaderManager` instead of a simple `FileLoader` as the
     * applications `translation.loader` instance.
     */
    protected function registerLoader()
    {
        $this->app->singleton("translation.loader", function ($app) {
            return new TranslationLoaderManager(
                $app["files"],
                $app["path.lang"]
            );
        });
    }
}
