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
        return <<<'blade'
<x-orbitali::checkbox-input id="status" name="status" title="Status" data-source="\Orbitali\Foundations\Datasources\Statuses" type="radio" required />
<x-orbitali::script-panel>
    $('#status-1').parent().addClass('custom-control-success');
    $('#status-0').parent().addClass('custom-control-danger');
    $('#status-2').parent().addClass('custom-control-dark');
</x-orbitali::script-panel>
blade;
    }
}
