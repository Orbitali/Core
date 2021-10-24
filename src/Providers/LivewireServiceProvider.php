<?php

namespace Orbitali\Providers;

use Livewire;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Blade;
use Orbitali\Http\Components\{
    DemoComponent,
    RepeaterComponent,
    InputGroupComponent,
    InputComponent
};

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
        Livewire::component("repeater", RepeaterComponent::class);
        Livewire::component("input.group", InputGroupComponent::class);
        Livewire::component("input", InputComponent::class);
    }
}
