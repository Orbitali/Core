@extends("Orbitali::inc.app")

@if(request("compact"))
    @section('container')
    <div id="page-container" class="page-header-dark main-content-boxed">
        <main id="main-container">
            <div class="content content-full p-0">
            @include("Orbitali::structure.model_edit",[
                "update_route" => "panel.menu.update",
                "model"=> $menu,
                "title" => trans(['native.panel.menu.title','Menüler']),
            ])
            </div>
        </main>
    </div>
    @endsection
@else
@section('content')
    @include("Orbitali::structure.model_edit",[
        "update_route" => "panel.menu.update",
        "model"=> $menu,
        "title" => trans(['native.panel.menu.title','Menüler']),
    ])
@endsection
@endif