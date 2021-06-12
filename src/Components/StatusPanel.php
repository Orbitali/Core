<?php

namespace Orbitali\Components;

class StatusPanel extends ContainerComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return "";
    }

    public static function staticRender(
        array $config,
        bool $isInContainer = false
    ) {
        $id = data_get($config, "id", uniqid("s-"));
        $parentField = $isInContainer ? ':parent="$component"' : "";
        $name = data_get($config, "name", "status");
        $title = data_get($config, "title", "Status");
        $type = data_get($config, "type", "radio");
        $required = "required";

        return <<<blade
<x-orbitali::checkbox-input id="$id" name="$name" title="$title" type="$type" data-source="\Orbitali\Foundations\Datasources\Statuses" $required $parentField />
<x-orbitali::script-panel>
    $('#$id-1').parent().addClass('custom-control-success');
    $('#$id-0').parent().addClass('custom-control-danger');
    $('#$id-2').parent().addClass('custom-control-dark');
</x-orbitali::script-panel>
blade;
    }
}
