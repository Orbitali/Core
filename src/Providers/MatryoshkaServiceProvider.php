<?php

namespace Orbitali\Providers;

use Blade;
use Orbitali\Foundations\BladeDirective;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class MatryoshkaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param Kernel $kernel
     */
    public function boot(Kernel $kernel)
    {
        if ($this->app->isLocal()) {
            //TODO: test
//            $kernel->pushMiddleware('Orbitali\Http\Middleware\FlushViews');
        }

        Blade::directive('cache', function ($expression) {
            $expression = str_replace(['(', ')'], '', $expression);
            return "<?php if (! app('Orbitali\Foundations\BladeDirective')->setUp({$expression})) : ?>";
        });
        Blade::directive('endcache', function () {
            return "<?php endif; echo app('Orbitali\Foundations\BladeDirective')->tearDown(); ?>";
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(BladeDirective::class);
    }
}
