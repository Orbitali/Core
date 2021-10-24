<div class="block block-rounded block-bordered" data-toggle="appear" wire:loading.class="block-mode-loading"
    wire:target="model">
    <div class="block-header block-header-default sticky-top">
        <h3 class="block-title">Demo</h3>
        <div class="block-options">
            <button wire:click="resetModel" title="{{trans([" native.reset","Reset"])}}" class="btn btn-sm
            btn-light js-tooltip">
                <i class="fa fa-fw fa-undo" aria-hidden="true"></i>
            </button>
            <button wire:click="save" title="{{trans([" native.reset","Reset"])}}" class="btn btn-sm
            btn-dual js-tooltip">
                <i class="fa fa-fw fa-save" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <div class="block-content">
        <x-Orbitali::inputs.group label="Addres" for="demo-address">
            <x-Orbitali::inputs.input model="model.address" />
        </x-Orbitali::inputs.group>
        <x-Orbitali::inputs.group label="E-Posta" for="demo-email">
            <x-Orbitali::inputs.input model="model.email" />
        </x-Orbitali::inputs.group>
        <x-Orbitali::inputs.group label="Telefon" for="demo-phone">
            <x-Orbitali::inputs.input model="model.phone" />
        </x-Orbitali::inputs.group>

        @php($panelId = "panelId")
        @php($activeKey = $panelState[$panelId] ?? $model->details->keys()[0])
        <div class="js-wizard-simple block block-rounded block-bordered"
            wire:init="attachPanel('{{$panelId}}','{{$activeKey}}')">
            <ul class="nav nav-tabs nav-tabs-alt sticky-top bg-white-95" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-trash small"></i></a>
                </li>
                <li class="nav-item" wire:click="createDetail('fr')">
                    <a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-plus small"></i></a>
                </li>
                @foreach ($model->details as $key=>$value)
                <li class="nav-item" wire:click="attachPanel('{{$panelId}}','{{$key}}')">
                    <a @class(["nav-link","active"=>$activeKey == $key ]) href="#tabId{{$key}}" data-toggle="tab"
                        role="tab">@lang("native.language.$value->language")
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
                @foreach ($model->details as $key => $value)
                <div @class(["tab-pane","active"=>$activeKey == $key]) id="tabId{{$key}}" role="tabpanel">
                    <x-Orbitali::inputs.group label="Name" for="model.details.{{$key}}.name">
                        <x-Orbitali::inputs.input />
                    </x-Orbitali::inputs.group>
                    <x-Orbitali::inputs.group label="Name" for="model.details.{{$key}}.about_title">
                        <x-Orbitali::inputs.input />
                    </x-Orbitali::inputs.group>
                </div>
                @endforeach
            </div>
        </div>


    </div>
</div>