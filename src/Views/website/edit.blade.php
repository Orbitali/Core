@extends("Orbitali::inc.app")

@section('content')
    @include("Orbitali::structure.model_edit",[
        "update_route" => "panel.website.update",
        "model"=> $website,
        "title" => trans(['native.panel.website.title','Websiteleri']),
    ])
@endsection