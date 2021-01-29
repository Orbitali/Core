@extends("Orbitali::inc.app")

@section('content')
    @include("Orbitali::structure.model_edit",[
        "update_route" => "panel.page.update",
        "model"=> $page,
        "title" => trans(['native.panel.node.title','Düğümler']),
    ])
@endsection