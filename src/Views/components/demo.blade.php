@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default sticky-top">
        <h3 class="block-title">Demo</h3>
        <div class="block-options">
            @if(!html()->readonly)
            {{html()->reset('<i class="fa fa-fw fa-undo"
                aria-hidden="true"></i>')->attribute("title",trans(["native.reset","Reset"]))->class('btn btn-sm
            btn-light js-tooltip')}}
            {{html()->submit('<i class="fa fa-fw fa-save"
                aria-hidden="true"></i>')->attribute("title",trans(["native.submit","Submit"]))->class('btn btn-sm
            btn-dual js-tooltip')}}
            @endif
        </div>
    </div>
    <div class="block-content">
        <livewire:demo-component />
    </div>
</div>
@endsection