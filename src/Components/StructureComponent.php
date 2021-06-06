<?php

namespace Orbitali\Components;

use Illuminate\View\Component;
use Illuminate\Container\Container;

class StructureComponent extends Component
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

    /**
     * Get the view / view contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\Support\Htmlable|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
<x-orbitali::text-input id="r1" name="domain" title="Domain" required />

<x-orbitali::tab-container id="tc1">
    <x-orbitali::tab-panel id="tp1" title="Test Title" :parent="$component">
        <x-orbitali::text-input id="r1" name="domain" title="Domain" :parent="$component" required />
    </x-orbitali::tab-panel>
</x-orbitali::tab-container>

<x-orbitali::detail-panel id="dp1">
    <x-orbitali::text-input id="ti1" name="name" title="Name" :parent="$component" required />
</x-orbitali::detail-panel>

<x-orbitali::repeater-panel id="rp1">
    <x-orbitali::text-input id="r1" name="languages" title="Language" :parent="$component" required />
</x-orbitali::repeater-panel>

<x-orbitali::select2-input id="s1" name="languages" title="Language" data-source="\Orbitali\Foundations\Datasources\Languages" prevent-sort multiple required />
<x-orbitali::select2-input id="s2" name="languages" title="Language" data-source="\Orbitali\Foundations\Datasources\Languages" />

<x-orbitali::dropzone-input id="d1" name="about_image" title="Banners" />
<x-orbitali::dropzone-input id="d2" name="banner_image" title="Banners" multiple max-files="3"/>

<x-orbitali::checkbox-input id="cb1" name="languages" title="Language" data-source="\Orbitali\Foundations\Datasources\Languages" />
<x-orbitali::checkbox-input id="cb2" name="languages" title="Language" data-source="\Orbitali\Foundations\Datasources\Languages" type="radio" />

<x-orbitali::textarea-input id="ta1" name="address" title="Address" />
<x-orbitali::textarea-input id="ta2" name="details[tr][feature2_text]" title="Address" auto-height />
<x-orbitali::textarea-input id="ta3" name="extras" title="Address" cols="6" rows="6" />

<x-orbitali::editor-input id="e1" name="details[tr][feature2_text]" title="Feature 2" />

<x-orbitali::slug-input id="si1" name="details[tr][url]" title="url" slug="/" />
<x-orbitali::text-input id="sr1" name="details[tr][name]" title="Name" required />


<x-orbitali::mask-input id="m1" name="details[tr][name]" title="Name" required overwrite="false" />
<x-orbitali::mask-input id="m2" name="details[tr][name]" title="Name" required mask="" />
<x-orbitali::mask-input id="m3" name="details[tr][name]" title="Name" required regex="" />
<x-orbitali::mask-input id="m4" name="details[tr][name]" title="Name" required lazy="true" />
<x-orbitali::mask-input id="m5" name="details[tr][name]" title="Name" required placeholder-char="*" />
blade;
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
