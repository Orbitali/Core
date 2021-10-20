@extends("Orbitali::inc.app")

@section('content')
    @include("Orbitali::structure.model_edit",[
        "update_route" => "panel.menu.update",
        "model"=> $menu,
        "title" => trans(['native.panel.menu.title','Menüler']),
    ])
@endsection