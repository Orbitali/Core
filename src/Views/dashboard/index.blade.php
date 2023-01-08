@extends("Orbitali::inc.app")

@section('content')
{{-- Overview --}}
<div class="d-flex justify-content-between align-items-center py-3">
    <h2 class="h3 font-w400 mb-0">Overview</h2>
    <div class="dropdown">
        <button type="button" class="btn btn-sm btn-alt-secondary px-3" id="dropdown-analytics-overview" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            {{$listRange[$selector]}}
            <i class="fa fa-fw fa-angle-down" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-analytics-overview">
            @foreach ($listRange as $key=>$name)
            <a class="dropdown-item" href="{{ route("panel.index",["range"=>$key]) }}">{{$name}}</a>
            @endforeach
        </div>
    </div>
</div>
<div class="row row-deck">
    <div class="col-sm-6 invisible" data-toggle="appear">
        <a class="block block-rounded block-fx-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="item item-circle bg-primary-lighter mx-auto my-3">
                    <i class="fa fa-users text-primary" aria-hidden="true"></i>
                </div>
                <div class="text-body-color display-4 font-w700">{{$visitors}}</div>
                <div class="text-muted mt-1">Visitors</div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 invisible" data-toggle="appear" data-timeout="150">
        <a class="block block-rounded block-fx-pop text-center" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="item item-circle bg-xinspire-lighter mx-auto my-3">
                    <i class="fa fa-eye text-xinspire-dark" aria-hidden="true"></i>
                </div>
                <div class="text-body-color display-4 font-w700">{{$pageViews}}</div>
                <div class="text-muted mt-1">Page views</div>
            </div>
        </a>
    </div>
</div>
{{-- END Overview --}}
@endsection
