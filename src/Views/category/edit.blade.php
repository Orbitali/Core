@extends("Orbitali::inc.app")

@section('content')
    @include("Orbitali::structure.model_edit",[
        "update_route" => "panel.category.update",
        "model"=> $category,
        "title" => trans(['native.panel.category.title','Kategoriler']),
    ])
@endsection