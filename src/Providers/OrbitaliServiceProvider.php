<?php

namespace Orbitali\Providers;

use Laravel\Socialite\SocialiteServiceProvider;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Middleware\CacheRequest;
use Orbitali\Http\Middleware\OrbitaliLoad;
use Orbitali\Http\Middleware\OrbitaliLocalization;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class OrbitaliServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $providers = [
        TranslationServiceProvider::class,
        MatryoshkaServiceProvider::class,
        SocialiteServiceProvider::class,
        EventServiceProvider::class
    ];

    /**
     * @var array
     */
    protected $aliases = [
        'Orbitali' => \Orbitali\Facades\Orbitali::class,
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
        if ($this->app->runningInConsole()) {
            $this->publishMigrations($baseFolder);
            $this->publishes([$baseFolder . 'Assets' => public_path('vendor/orbitali')], 'public');
            $this->publishes([$baseFolder . 'Config' => config_path()]);
        } else {
            $this->settingUpConfigs($baseFolder);
            $this->bladeDirectives();
            $this->loadRoutesFrom($baseFolder . 'Routes' . DIRECTORY_SEPARATOR . 'web.php');

            $this->app['Illuminate\Contracts\Http\Kernel']->prependMiddleware(OrbitaliLocalization::class);
//            $this->app['Illuminate\Contracts\Http\Kernel']->prependMiddleware(OrbitaliLoad::class);

            $this->app['router']->prependMiddlewareToGroup('web', OrbitaliLoad::class);
            array_splice($this->app['router']->middlewarePriority, 1, 0, [OrbitaliLoad::class]);

            if (!$this->app->isLocal()) {
                $this->app['router']->prependMiddlewareToGroup('web', CacheRequest::class);
                array_splice($this->app['router']->middlewarePriority, 1, 0, [CacheRequest::class]);
            }
        }
    }

    //region Config

    protected function publishMigrations($baseFolder)
    {
        $migrationsRaw = array_diff(scandir($baseFolder . '/Database/Migrations'), ['..', '.']);
        $migrations = [];
        $timestamp = date('Y_m_d_His', time());
        foreach ($migrationsRaw as $migration) {
            $migration = str_replace(".php.stub", "", $migration);
            if (!class_exists(studly_case($migration))) {
                $filename = $baseFolder . "Database/Migrations/$migration.php.stub";
                $migrations[$filename] = database_path("migrations/" . $timestamp . "_$migration.php");
            }
        }
        $this->publishes($migrations, 'migrations');
    }

    protected function settingUpConfigs($baseFolder)
    {
        $this->mergeConfigFrom($baseFolder . 'Config' . DIRECTORY_SEPARATOR . 'orbitali.php', "orbitali");
        $this->mergeWith('auth', 'orbitali.auth');
        $this->mergeWith('services', 'orbitali.services');
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
        Blade::directive('lang', function ($expression) {
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
        $this->registerProvoiders();
        $this->registerAliases();
    }

    protected function registerProvoiders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    protected function registerAliases()
    {
        foreach ($this->aliases as $alias => $abstract) {
            $this->app->alias($abstract, $alias);
        }
    }

}
