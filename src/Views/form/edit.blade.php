@extends("Orbitali::inc.app")

@section('content')
@include("Orbitali::structure.model_edit",[
"update_route" => "panel.form.update",
"model"=> $form,
"title" => trans(['native.panel.form.title','Formlar']),
])
@endsection