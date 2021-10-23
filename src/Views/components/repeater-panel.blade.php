@php($updateCount($model))
<x-orbitali::tab-container id="{{$id}}" :data-repeater-count="$that->count"
    :data-repeater-names="json_encode($that->inputNames)" :parent="$that->parent">
    @for ($i = 1; $i <= $that->count; $i++)
        @php($title=trans(["native.panel.index.$i",$i]))
        <x-orbitali::tab-panel id="{{$id}}-{{$i}}" :title="$title" :repeater-id="$i" :parent="$component">
            @foreach ($that->renderableChildren as $child)
            {!! $child($component,$i) !!}
            @endforeach
        </x-orbitali::tab-panel>
        @endfor
</x-orbitali::tab-container>