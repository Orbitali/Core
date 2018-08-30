<?php

namespace Orbitali\Providers;

use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Middleware\CacheRequest;
use Illuminate\Support\ServiceProvider;

class OrbitaliServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $providers = [
        TranslationServiceProvider::class,
        MatryoshkaServiceProvider::class
    ];

    /**
     * @var array
     */
    protected $aliases = [
        'Orbitali' => \Orbitali\Facades\Orbitali::class,
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
            $this->loadRoutesFrom($baseFolder . 'Routes' . DIRECTORY_SEPARATOR . 'web.php');
            if (!$this->app->isLocal()) {
                $this->app['router']->pushMiddlewareToGroup('web', CacheRequest::class);
            }
        }
    }

    protected function publishMigrations($baseFolder)
    {
        $migrationsRaw = [
            "create_users_table",
            "create_language_parts_table"
        ];
        $migrations = [];
        $timestamp = date('Y_m_d_His', time());
        foreach ($migrationsRaw as $migration) {
            $filename = $baseFolder . "Database/Migrations/$migration.php.stub";
            if (!class_exists(studly_case($migration), false) && file_exists($filename)) {
                $migrations[$filename] = database_path("migrations/" . $timestamp . "_$migration.php");
            }
        }
        $this->publishes($migrations, 'migrations');
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
