@php($activeKey = $panelState[$panelId] ?? $repeater->keys()[0])
<div class="js-wizard-simple block block-rounded block-bordered"
    wire:init="attachPanel('{{$panelId}}','{{$activeKey}}')">
    <ul class="nav nav-tabs nav-tabs-alt sticky-top bg-white-95" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-trash small"></i></a>
        </li>
        <li class="nav-item" wire:click="createRange()">
            <a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-plus small"></i></a>
        </li>
        @foreach ($repeater as $key=>$value)
        <li class="nav-item" wire:click="attachPanel('{{$panelId}}','{{$key}}')">
            <a @class(["nav-link","active"=>$activeKey == $key ]) href="#{{$panelId}}{{$key}}" data-toggle="tab"
                role="tab">@lang("native.panel.index.".$loop->index+1)
                @if(($errorCount = count($errors->get("model.details.$key.*"))) > 0)
                <span class="badge badge-pill badge-danger">
                    {{$errorCount}}
                </span>
                @endif
            </a>
        </li>
        @endforeach
    </ul>
    <div class="block-content block-content-full tab-content">
        @foreach ($repeater as $key => $value)
        <div @class(["tab-pane","active"=>$activeKey == $key]) id="{{$panelId}}{{$key}}" role="tabpanel">
            {!! str_replace([$replace],[$key],$slot) !!}
        </div>
        @endforeach
    </div>
</div>