<?php

namespace Orbitali\Providers;

use Laravel\Socialite\SocialiteServiceProvider;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Middleware\CacheRequest;
use Orbitali\Http\Middleware\OrbitaliLoad;
use Orbitali\Http\Middleware\OrbitaliLocalization;
use Orbitali\Http\Models\CategoryDetail;
use Orbitali\Http\Models\PageDetail;
use Orbitali\Http\Models\SitemapDetail;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
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
            $this->loadMigrationsFrom($baseFolder . 'Database' . DIRECTORY_SEPARATOR . 'Migrations');
            $this->publishes([$baseFolder . 'Assets' => public_path('vendor/orbitali')], 'public');
            $this->publishes([$baseFolder . 'Config' => config_path()]);
        } else {
            $this->settingUpConfigs($baseFolder);
            $this->bladeDirectives();
            $this->loadRoutesFrom($baseFolder . 'Routes' . DIRECTORY_SEPARATOR . 'web.php');

            $this->app['Illuminate\Contracts\Http\Kernel']->prependMiddleware(OrbitaliLocalization::class);

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
        $this->app->bind("Orbitali", Orbitali::class);
        $this->registerProvoiders();
        $this->registerAliases();
        $this->extendBlueprint();
        $this->relationMorphMap();
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

    protected function extendBlueprint()
    {
        Blueprint::macro('details', function ($name, $table = null) {
            $this->increments('id');
            $this->unsignedInteger($name . '_id')->index();
            $this->string('language', 64)->index();
            $this->string('country', 10)->nullable()->index();
            $this->string('name');

            $this->unique([$name . '_id', 'language', 'country']);

            $this->foreign($name . '_id')
                ->references('id')
                ->on($table ?? str_plural($name))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('extras', function ($name, $table = null) {
            $this->increments('id');
            $this->unsignedInteger($name . '_id')->index();
            $this->string('key');
            $this->string('value');

            $this->unique([$name . '_id', 'key']);

            $this->foreign($name . '_id')
                ->references('id')
                ->on($table ?? str_plural($name))
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('defaultFields', function () {
            $this->unsignedInteger("user_id")->nullable();
            $this->integer("status")->default(3);
        });

        Blueprint::macro('nestable', function ($parent = "") {
            $this->unsignedInteger("lft")->nullable();
            $this->unsignedInteger("rgt")->nullable();
            $this->unsignedInteger("depth")->nullable();

            $index = ["lft", "rgt", "depth"];

            if ($parent != "") {
                $this->unsignedInteger($parent)->nullable()->index();
                $index[] = $parent;
            }

            $this->index($index);
        });

        Blueprint::macro('orderable', function () {
            $this->unsignedInteger("order")->nullable()->index();
        });

    }

    protected function relationMorphMap()
    {
        Relation::morphMap([
            "category_details" => CategoryDetail::class,
            "sitemap_details" => SitemapDetail::class,
            "page_details" => PageDetail::class,
        ]);
    }

}
