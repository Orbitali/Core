<?php

namespace Orbitali\Providers;

use Laravel\Socialite\SocialiteServiceProvider;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Middleware\CacheRequest;
use Orbitali\Http\Middleware\OrbitaliLoader;
use Orbitali\Http\Models\Ability;
use Orbitali\Http\Models\Role;
use Silber\Bouncer\BouncerFacade;
use Silber\Bouncer\BouncerServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class OrbitaliServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $providers = [
        BouncerServiceProvider::class,
        BlueprintServiceProvider::class,
        TranslationServiceProvider::class,
        MatryoshkaServiceProvider::class,
        SocialiteServiceProvider::class,
        SeedServiceProvider::class,
        EventServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $aliases = [
        'Socialite' => \Laravel\Socialite\Facades\Socialite::class
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $baseFolder = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;
        $this->settingUpConfigs($baseFolder);

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom($baseFolder . 'Database' . DIRECTORY_SEPARATOR . 'Migrations');
            $this->publishes([$baseFolder . 'Assets' => public_path('vendor/orbitali')], 'public');
            $this->publishes([$baseFolder . 'Config' => config_path()]);
        } else {
            $this->bladeDirectives();
            $this->loadRoutesFrom($baseFolder . 'Routes' . DIRECTORY_SEPARATOR . 'web.php');
            $this->loadViewsFrom($baseFolder . "Views", "Orbitali");

            $this->app['Illuminate\Contracts\Http\Kernel']->pushMiddleware(OrbitaliLoader::class);
            if (!$this->app->isLocal()) {
                $this->app['router']->prependMiddlewareToGroup('web', CacheRequest::class);
                array_splice($this->app['router']->middlewarePriority, 1, 0, [CacheRequest::class]);
            }
        }
    }

    //region Config

    protected function settingUpConfigs($baseFolder)
    {
        $this->mergeConfigFrom($baseFolder . 'Config' . DIRECTORY_SEPARATOR . 'orbitali.php', "orbitali");
        $this->mergeWith('auth', 'orbitali.auth');
        $this->mergeWith('services', 'orbitali.services');
        $this->mergeWith('clockwork', 'orbitali.clockwork');
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param  string $path
     * @param  string $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, $this->mergeConfig(require $path, $config));
    }

    /**
     * Merges the configs together and takes multi-dimensional arrays into account.
     *
     * @param  array $original
     * @param  array $merging
     * @return array
     */
    protected function mergeConfig(array $original, array $merging)
    {
        $array = array_merge($original, $merging);
        foreach ($original as $key => $value) {
            if (!is_array($value)) {
                continue;
            }
            if (!Arr::exists($merging, $key)) {
                continue;
            }
            if (is_numeric($key)) {
                continue;
            }
            $array[$key] = $this->mergeConfig($value, $merging[$key]);
        }
        return $array;
    }

    //endregion

    /**
     * @param array $base
     * @param array $overwrite
     * @return void
     */
    protected function mergeWith($base, $overwrite)
    {
        config([$base => $this->mergeConfig(config($base), config($overwrite))]);
    }

    protected function bladeDirectives()
    {
        function stripParentheses($expression)
        {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }
            return $expression;
        }

        Blade::directive('lang', function ($expression) {
            $expression = stripParentheses($expression);
            return "<?php echo trans({$expression}); ?>";
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Orbitali::class);
        $this->app->bind("Orbitali", Orbitali::class);

        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }

        foreach ($this->aliases as $alias => $abstract) {
            $this->app->alias($abstract, $alias);
        }

        BouncerFacade::useAbilityModel(Ability::class);
        BouncerFacade::useRoleModel(Role::class);
    }
}
