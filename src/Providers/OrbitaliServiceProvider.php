<?php

namespace Orbitali\Providers;

use Laravel\Socialite\SocialiteServiceProvider;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Middleware\CacheRequest;
use Orbitali\Http\Models\User;
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
        } else {
            $this->settingUpConfigs();
            $this->bladeDirectives();
            $this->loadRoutesFrom($baseFolder . 'Routes' . DIRECTORY_SEPARATOR . 'web.php');
            if (!$this->app->isLocal()) {
                $this->app['router']->pushMiddlewareToGroup('web', CacheRequest::class);
            }
        }
    }

    protected function settingUpConfigs()
    {
        config(['auth.providers.users.model' => User::class]);
    }

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
