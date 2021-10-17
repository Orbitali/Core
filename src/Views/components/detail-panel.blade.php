<x-orbitali::tab-container id="{{$id}}">
    @foreach($languages as $language => $title)
    <x-orbitali::tab-panel id="{{$id}}-{{$language}}" title="{{$title}}" :parent="$component">
        @foreach ($that->children as $child)
        @php($renderChild($language, $child, $component))
        @endforeach
    </x-orbitali::tab-panel>
    @endforeach
</x-orbitali::tab-container>