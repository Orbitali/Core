@extends("Orbitali::inc.app")

@section('content')
    @include("Orbitali::structure.model_edit",[
        "update_route" => "panel.node.update",
        "model"=> $node,
        "title" => trans(['native.panel.node.title','Düğümler']),
    ])
@endsection