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

        <x-Orbitali::repeater panelId="demo1" :repeater="$model->details" :panelState="$panelState" replace="@key">
            <x-Orbitali::inputs.group label="Name" for="model.details.@key.name">
                <x-Orbitali::inputs.input />
            </x-Orbitali::inputs.group>
            <x-Orbitali::inputs.group label="About Us" for="model.details.@key.about_title">
                <x-Orbitali::inputs.input />
            </x-Orbitali::inputs.group>
        </x-Orbitali::repeater>

        <x-Orbitali::repeater2 panelId="demo2" :repeater="collect(range(4,1))" :panelState="$panelState" replace="@key">
            <x-Orbitali::inputs.group label="Resim Adı" for="model.feature_icon.@key">
                <x-Orbitali::inputs.input />
            </x-Orbitali::inputs.group>
        </x-Orbitali::repeater2>


        <x-Orbitali::repeater2 panelId="demo3" :repeater="collect(range(4,1))" :panelState="$panelState"
            replace="@key1">
            <x-Orbitali::inputs.group label="Resim Adı" for="model.feature_icon.@key1">
                <x-Orbitali::inputs.input />
            </x-Orbitali::inputs.group>
            <x-Orbitali::repeater panelId="demo4" :repeater="$model->details" :panelState="$panelState" replace="@key2">
                <x-Orbitali::inputs.group label="Başlık" for="model.details.@key2.feature_title.@key1">
                    <x-Orbitali::inputs.input />
                </x-Orbitali::inputs.group>
            </x-Orbitali::repeater>
        </x-Orbitali::repeater2>
    </div>
</div>