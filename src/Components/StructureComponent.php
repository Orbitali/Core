<?php

namespace Orbitali\Components;

use Illuminate\View\Component;
use Illuminate\Container\Container;

class StructureComponent extends BaseComponent
{
    private $structure;
    private $directory;
    private $viewFile;
    /**
     * Create a new component instance.
     *
     * @param  Model  $structure
     * @return void
     */
    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    public function update()
    {
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render()
    {
        $children = $this->structure->data;
        $content = PHP_EOL;
        foreach ($children as $child) {
            $componentClass = self::componentClassFinder($child);
            $content .= $componentClass::staticRender($child, false) . PHP_EOL;
        }
        return $content;
    }

    /**
     * Resolve the Blade view or view file that should be used when rendering the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function resolveView()
    {
        $this->directory = config("view.compiled");
        $content = $this->structure->getRawOriginal("data");
        $this->viewFile = "$this->directory/" . sha1($content) . ".blade.php";
        return $this->createBladeViewFromString(app("view"), $this->render());
    }

    /**
     * Create a Blade view with the raw component string content.
     *
     * @param  string  $contents
     * @return string
     */
    protected function createBladeViewFromString($factory, $contents)
    {
        if (!is_file($this->viewFile)) {
            if (!is_dir($this->directory)) {
                mkdir($this->directory, 0755, true);
            }
            file_put_contents($this->viewFile, $contents);
        }
        $factory->addNamespace("__components", $this->directory);
        return "__components::" . basename($this->viewFile, ".blade.php");
    }
}
