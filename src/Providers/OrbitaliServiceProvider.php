<?php

namespace Orbitali\Providers;

use Clockwork\Clockwork;
use Laravel\Socialite\SocialiteServiceProvider;
use Orbitali\Foundations\Html\Html;
use Orbitali\Foundations\Orbitali;
use Orbitali\Http\Middleware\CacheRequest;
use Orbitali\Http\Middleware\OrbitaliLoader;
use Orbitali\Http\Middleware\Localization;
use Orbitali\Http\Models\Ability;
use Orbitali\Http\Models\Role;
use Silber\Bouncer\BouncerFacade;
use Silber\Bouncer\BouncerServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

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
        TaskServiceProvider::class,
        MetaTagsServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $aliases = [
        "Socialite" => \Laravel\Socialite\Facades\Socialite::class,
    ];

    protected $baseFolder =
        __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(
                $this->baseFolder .
                    "Database" .
                    DIRECTORY_SEPARATOR .
                    "Migrations"
            );
            $this->publishes(
                [
                    $this->baseFolder . "Assets/compiled" => public_path(
                        "vendor/orbitali"
                    ),
                ],
                "public"
            );
            $this->publishes([$this->baseFolder . "Config" => config_path()]);
        }

        $this->aliasMiddleware();
        $this->bladeDirectives();
        $this->validatorExtends();
        $this->loadRoutesFrom(
            $this->baseFolder . "Routes" . DIRECTORY_SEPARATOR . "web.php"
        );
        $this->loadViewsFrom($this->baseFolder . "Views", "Orbitali");
        $this->bindViewComposer();

        $this->app["Illuminate\Contracts\Http\Kernel"]->pushMiddleware(
            OrbitaliLoader::class
        );

        if (!$this->app->isLocal()) {
            $this->app["router"]->pushMiddlewareToGroup(
                "web",
                CacheRequest::class
            );
            array_push(
                $this->app["router"]->middlewarePriority,
                CacheRequest::class
            );
        } else {
            $this->commands([\Orbitali\Console\ControllerMakeCommand::class]);
        }

        $this->commands([\Orbitali\Console\Backup::class]);
    }

    protected function bindViewComposer()
    {
        View::composer("Orbitali::inc.nav", function ($view) {
            $menu = (new \Orbitali\Foundations\MenuManager())->menuBuilder(1);
            orbitali("menu", $menu);
        });
    }

    //region Config

    protected function aliasMiddleware()
    {
        app("router")->aliasMiddleware("localization", Localization::class);
    }

    protected function settingUpConfigs($baseFolder)
    {
        $this->mergeConfigFrom(
            $baseFolder . "Config" . DIRECTORY_SEPARATOR . "orbitali.php",
            "orbitali"
        );
        $this->mergeWith("auth", "orbitali.auth");
        $this->mergeWith("services", "orbitali.services");
        $this->mergeWith("clockwork", "orbitali.clockwork");
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
        $config = $this->app["config"]->get($key, []);
        $this->app["config"]->set(
            $key,
            $this->mergeConfig(require $path, $config)
        );
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
        config([
            $base => $this->mergeConfig(config($base), config($overwrite)),
        ]);
    }

    private function stripParentheses($expression)
    {
        if (Str::startsWith($expression, "(")) {
            $expression = substr($expression, 1, -1);
        }
        return $expression;
    }

    protected function bladeDirectives()
    {
        Blade::directive("lang", function ($expression) {
            $expression = $this->stripParentheses($expression);
            return "<?php echo trans({$expression}); ?>";
        });
    }

    protected function validatorExtends()
    {
        Validator::extendImplicit("checkbox", function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            $data = $validator->getData();

            $data[$attribute] = filter_var($value, FILTER_VALIDATE_BOOLEAN);

            $validator->setData($data);
            return true;
        });

        Validator::extendImplicit("hash", function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            $data = $validator->getData();
            if (
                in_array("skip-empty", $parameters) &&
                empty($data[$attribute])
            ) {
                unset($data[$attribute]);
            } else {
                $data[$attribute] = Hash::make($value);
            }
            $validator->setData($data);
            return true;
        });
    }

    protected function configureClockWork()
    {
        $this->app->singleton("clockwork.storage", function ($app) {
            return $app["clockwork.support"]->makeStorage();
        });

        $this->app->singleton("clockwork.authenticator", function ($app) {
            return $app["clockwork.support"]->makeAuthenticator();
        });

        $this->app["clockwork"]
            ->setAuthenticator($this->app["clockwork.authenticator"])
            ->setStorage($this->app["clockwork.storage"]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->settingUpConfigs($this->baseFolder);

        $this->app->singleton(Html::class);
        $this->app->bind("Orbitali", Orbitali::class);
        $this->app->singleton(Orbitali::class);

        $this->configureClockWork($this->baseFolder);

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
