<x-orbitali::tab-container id="{{$id}}" :parent="$that->parent">
    @foreach($languages as $language => $title)
    <x-orbitali::tab-panel id="{{$id}}-{{$language}}" title="{{$title}}" :parent="$component">
        @foreach ($that->renderableChildren as $child)
        {!! $child($component,$language) !!}
        @endforeach
    </x-orbitali::tab-panel>
    @endforeach
</x-orbitali::tab-container>