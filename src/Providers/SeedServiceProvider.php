<?php

namespace Orbitali\Providers;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Output\ConsoleOutput;

class SeedServiceProvider extends ServiceProvider
{
    protected $seedsPath = "/../Database/Seeds";

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->shouldApplySeeds()) {
            $this->addSeedsAfterConsoleCommandFinished();
        }
    }

    public function shouldApplySeeds()
    {
        return $this->app->runningInConsole() &&
            $this->isConsoleCommandContains(
                ["db:seed", "--seed"],
                ["--class", "help", "-h"]
            );
    }

    /**
     * Get a value that indicates whether the current command in console
     * contains a string in the specified $fields.
     *
     * @param string|array $containOptions
     * @param string|array $excludeOptions
     *
     * @return bool
     */
    protected function isConsoleCommandContains(
        $containOptions,
        $excludeOptions = null
    ): bool {
        $args = Request::server("argv", null);
        if (is_array($args)) {
            $command = implode(" ", $args);
            if (
                $this->str_contains($command, $containOptions) &&
                ($excludeOptions == null ||
                    !$this->str_contains($command, $excludeOptions))
            ) {
                return true;
            }
        }
        return false;
    }

    private function str_contains($str, $arr)
    {
        $res = false;
        foreach ($arr as $item) {
            $res |= str_contains($str, $item);
            if ($res) {
                break;
            }
        }
        return $res;
    }

    /**
     * Add seeds from the $seed_path after the current command in console finished.
     */
    protected function addSeedsAfterConsoleCommandFinished()
    {
        Event::listen(CommandFinished::class, function (
            CommandFinished $event
        ) {
            // Accept command in console only,
            // exclude all commands from Artisan::call() method.
            if ($event->output instanceof ConsoleOutput) {
                $this->addSeedsFrom(__DIR__ . $this->seedsPath);
            }
        });
    }

    /**
     * Register seeds.
     *
     * @param string $seedsPath
     * @return void
     */
    protected function addSeedsFrom($seedsPath)
    {
        $file_names = glob($seedsPath . "/*.php");
        foreach ($file_names as $filename) {
            $classes = $this->getClassesFromFile($filename);
            foreach ($classes as $class) {
                Artisan::call("db:seed", [
                    "--class" => $class,
                    "--force" => "",
                ]);
            }
        }
    }

    /**
     * Get full class names declared in the specified file.
     *
     * @param string $filename
     * @return array an array of class names.
     */
    private function getClassesFromFile(string $filename): array
    {
        // Get namespace of class (if vary)
        $namespace = "";
        $lines = file($filename);
        $namespaceLines = preg_grep("/^namespace /", $lines);
        if (is_array($namespaceLines)) {
            $namespaceLine = array_shift($namespaceLines);
            $match = [];
            preg_match('/^namespace (.*);$/', $namespaceLine, $match);
            $namespace = array_pop($match);
        }
        // Get name of all class has in the file.
        $classes = [];
        $php_code = file_get_contents($filename);
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if (
                $tokens[$i - 2][0] == T_CLASS &&
                $tokens[$i - 1][0] == T_WHITESPACE &&
                $tokens[$i][0] == T_STRING
            ) {
                $className = $tokens[$i][1];
                $classes[] =
                    $namespace !== ""
                        ? $namespace . "\\$className"
                        : $className;
            }
        }
        return $classes;
    }
}
