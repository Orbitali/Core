<?php

namespace Orbitali\Components;

class ScriptPanel extends ContainerComponent
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return <<<'blade'
@push('scripts')
    <script type="text/javascript">{{$slot}}</script>
@endpush
blade;
    }
}
