<?php

namespace Orbitali\Providers;

use Illuminate\Support\ServiceProvider;
use Orbitali\Components\BaseComponent;
use Orbitali\Components\InputComponent;
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

        $this->app->resolving(InputComponent::class, function (
            $inputComponent,
            $app
        ) {
            $app->build(function ($app, $parameters) use ($inputComponent) {
                $inputComponent->inputComponentBoot($app, $parameters);
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
