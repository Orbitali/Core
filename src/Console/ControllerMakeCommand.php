<?php

namespace Orbitali\Console;

use Illuminate\Console\GeneratorCommand;
use InvalidArgumentException;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = "orbitali:creator";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new controller class";

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = "Controller";

    /**
     * Indicates whether the command should be shown in the Artisan command list.
     *
     * @var bool
     */
    protected $hidden = true;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = "/Stubs/controller.plain.stub";
        return $this->resolveStubPath($stub);
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . "\Http\Controllers";
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in the base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);
        $methodName = $this->option("method");
        $replace = [
            "{{ method }}" => $methodName,
            "{{method}}" => $methodName,
            "use {$controllerNamespace}\Controller;\n" => "",
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match("([^A-Za-z0-9_/\\\\])", $model)) {
            throw new InvalidArgumentException(
                "Model name contains invalid characters."
            );
        }

        return $this->qualifyModel($model);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                "type",
                "t",
                InputOption::VALUE_REQUIRED,
                "Manually specify the controller stub file to use.",
            ],
            [
                "method",
                "m",
                InputOption::VALUE_REQUIRED,
                "Generate a controller for the given method.",
            ],
        ];
    }
}
