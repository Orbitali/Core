<?php

namespace Orbitali\Components;

class StylePanel extends ContainerComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
@push('styles')
    <style type="text/css">{{$slot}}</style>
@endpush
blade;
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $content = data_get($config, "content");

        return <<<blade
<x-orbitali::style-panel>
$content
</x-orbitali::style-panel>
blade;
    }
}
