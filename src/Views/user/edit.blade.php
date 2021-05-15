@extends("Orbitali::inc.app")

@section('content')
@include("Orbitali::structure.model_edit",[
"update_route" => "panel.user.update",
"model"=> $user,
"title" => trans(['native.panel.user.title','Kullanıcılar']),
])
@endsection