@extends("Orbitali::inc.app")

@section('content')
<div class="block block-rounded block-bordered invisible" data-toggle="appear">
    <div class="block-header block-header-default">
        <h3 id="page_desc" class="block-title">{{$title}}</h3>
        <div class="block-options">
            @if($search)
            <form class="d-none d-sm-inline-block" method="GET">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-alt" type="text" placeholder="Search"
                        value="{{request("q")}}" name="q" />
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-light bg-body border-0">
                            <i class="fa fa-fw fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
            @endif
            @foreach ($options as $option)
            <a href="{{data_get($option,"route")}}"
                class="btn btn-sm btn-light js-tooltip {{data_get($option,"class")}}"
                title="{{data_get($option,"title")}}">
                <i class="fas fa-fw {{data_get($option,"icon")}}" aria-hidden="true"></i>{{data_get($option,"text")}}
            </a>
            @endforeach
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-borderless table-vcenter table-hover" aria-describedby="page_desc">
                <thead>
                    <tr>
                        @foreach ($columns as $column)
                        <th scope="col">{{$column["title"]}}</th>
                        @endforeach
                        @if(count($actions) > 0)
                        <th class="min-w px-0" scope="col"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($query as $entity)
                    @can('*',$entity)
                    <tr>
                        @foreach ($columns as $column)
                        @if(Illuminate\Support\Str::endsWith($column["name"],"status"))
                        <td class="text-center min-w"><i
                                class="fa fa-sm fa-circle text-{{ ["danger","success","dark"][data_get($entity,$column["name"])??0] }}"
                                aria-hidden="true"></i>
                        </td>
                        @else
                        <td>
                            @php($render = data_get($entity,$column["name"]))
                            @if (is_array($render))
                            <button type="button" class="btn btn-light btn-sm js-tooltip w-100" data-toggle="tooltip"
                                data-animation="true" title="{{ implode(", ",$render) }}">
                                {{ count($render) }}
                            </button>
                            @else
                            {{$render}}
                            @endif
                        </td>
                        @endif
                        @endforeach
                        @if(count($actions) > 0)
                        <td class="text-center min-w">
                            <div class="btn-group">
                                @foreach ($actions as $action)
                                @php($act = $action($entity))
                                @if(isset($act) && count((array)$act)>0)
                                <a href="{{data_get($act,"route")}}"
                                    class="btn btn-sm btn-primary js-tooltip {{data_get($act,"class")}}"
                                    data-toggle="tooltip" data-animation="true" title="{{data_get($act,"title")}}"
                                    tabindex="1">
                                    <i class="fa {{data_get($act,"icon")}}"
                                        aria-hidden="true"></i>{{data_get($act,"text")}}
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endcan
                    @empty
                    <tr>
                        <td class="text-center" colspan="100%">@lang(['native.panel.empty_record',"No Record
                            Found"])</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            {!! $query->links('Orbitali::inc.paginate') !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<template id="block_remove_form_template" data-title="@lang(['native.are.you.sure'," Emin misiniz ?"])">
    <p class="mb-1">@lang(['native.wont.recover','İşlemi geri getiremeyeceksiniz'])</p>
    <div class="d-flex justify-content-between">
        <button data-submit class="btn btn-sm btn-alt-danger flex-grow-1 mr-1">@lang(['native.yes','Evet'])</button>
        <button data-close class="btn btn-sm btn-light flex-grow-1 ml-1">@lang(['native.cancel','İptal'])</button>
    </div>
</template>
@endpush