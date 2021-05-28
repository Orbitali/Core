@extends("Orbitali::inc.app")

@section('content')
@include("Orbitali::structure.model_edit",[
"update_route" => "panel.task.update",
"model"=> $task,
"title" => trans(['native.panel.task.title','Task']),
])
@endsection