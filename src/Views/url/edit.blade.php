@extends("Orbitali::inc.app")

@section('content')
@include("Orbitali::structure.model_edit",[
"update_route" => "panel.url.update",
"model"=> $url,
"title" => trans(['native.panel.url.title','Url']),
])
@endsection