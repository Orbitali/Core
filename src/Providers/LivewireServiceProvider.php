<?php

namespace Orbitali\Providers;

use Livewire;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Orbitali\Http\Components\DemoComponent;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Kernel $kernel
     */
    public function boot(Kernel $kernel)
    {
        Livewire::component("demo-component", DemoComponent::class);
    }
}
