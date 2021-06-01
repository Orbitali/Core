<?php

namespace Orbitali\Providers;

use Illuminate\Support\ServiceProvider;
use Orbitali\Components\BaseComponent;
use Illuminate\Support\Facades\Blade;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving(BaseComponent::class, function (
            $baseComponent,
            $app
        ) {
            $app->build(function ($app, $parameters) use ($baseComponent) {
                $baseComponent->baseComponentBoot($app, $parameters);
            });
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::componentNamespace("Orbitali\\Components", "orbitali");
    }
}
